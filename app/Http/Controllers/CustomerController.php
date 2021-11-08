<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index() {
        return Inertia::render('Customer/Index', [
            'customers' => Customer::latest('id')->paginate(10),
        ]);
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
                    'notes' => '',
                    'files' => [],
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
        $customer->addMultipleMediaFromRequest(['info.files'])->each(function ($fileAdder) {
            $fileAdder->toMediaCollection('customers');
        });
        return Inertia::render('Customer/Index');
    }

    public function edit(Customer $customer) {
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
        return Inertia::render('Customer/Index');
    }

    public function destroy(Customer $customer) {
        $customer->delete();
        return response()->noContent();
    }
}
