<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function getCustomers(Request $request) {
        $customers = Customer::query();
        $customers = $customers->latest('id');
        if ($request->search) {
            $customers = $customers->where('info->cmnd->number', 'like', '%'.$request->search.'%');
        }
        return response()->json($customers->paginate(10));
    }

    public function index() {
        return Inertia::render('Customer/Index');
    }

    public function create() {
        return Inertia::render('Customer/Modify', [
            'customer' => [
                'info' => [
                    'name' => '',
                    'dob' => '',
                    'cmnd' => [
                        'number' => '',
                        'date' => '',
                        'place' => '',
                    ],
                    'work' => '',
                    'income' => '',
                    'household' => '',
                    'place' => '',
                    'phone' => '',
                    'loan' => [
                        'amt' => '',
                        'time' => '',
                    ],
                    'assets' => '',
                    'notes' => [
                        'saler' => [],
                        'appraiser' => [],
                    ],
                    'files' => [
                        'saler' => [],
                        'appraiser' => [],
                    ],
                    'relative_contacts' => [[
                        'phone' => '',
                        'relative' => ''
                    ], [
                        'phone' => '',
                        'relative' => ''
                    ]]
                ]
            ]
        ]);
    }

    public function store(CustomerRequest $request) {
        $validated = $request->validated();
        unset($validated['info']['files']);
        $customer = Customer::create($validated);

        if (count($request->info['files']['saler'])) {
            $customer->addMultipleMediaFromRequest(['info.files.saler'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('saler_files');
            });
        }
        if (count($request->info['files']['appraiser'])) {
            $customer->addMultipleMediaFromRequest(['info.files.appraiser'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('appraiser_files');
            });
        }

        return Inertia::render('Customer/Index');
    }

    public function edit(Customer $customer) {
        $customer->setRelation('payments', $customer->payments()->paginate(10));
        return Inertia::render('Customer/Modify', [
            'customer' => $customer,
        ]);
    }

    public function approved(Request $request, Customer $customer) {
        $type = ['is_appraised', 'is_disbursed'];
        if (in_array($request->type, $type)) {
            $customer->{$request->type} = true;
            $customer->save();
            return response()->noContent();
        }
    }

    public function update(CustomerRequest $request, Customer $customer) {
        $customer->update($request->validated());
        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer) {
        $this->authorize('delete', $customer);
        $customer->delete();
        return response()->noContent();
    }
}
