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
                    'images' => [
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
        $validated['info']['images']['saler'] = $validated['info']['images']['appraiser'] = [];
        $customer = $request->user()->customers()->create($validated);

        if (isset($request->info['images']['saler']) && count($request->info['images']['saler'])) {
            $customer->addMultipleMediaFromRequest(['info.images.saler'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('saler_files');
            });
        }
        if (isset($request->info['images']['appraiser']) && count($request->info['images']['appraiser'])) {
            $customer->addMultipleMediaFromRequest(['info.images.appraiser'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('appraiser_files');
            });
        }

        return Inertia::render('Customer/Index');
    }

    public function edit(Customer $customer) {
        $customer->setRelation('appraiser', $customer->appraiser()->first());
        $customer->setRelation('payments', $customer->payments()->paginate(10));
        return Inertia::render('Customer/Modify', [
            'customer' => $customer,
        ]);
    }

    public function approved(Request $request, Customer $customer) {
        $type = ['appraised', 'disbursed'];
        if (in_array($request->type, $type)) {
            $customer->{'is_' . $request->type} = true;
            $customer->{$request->type . '_by'} = $request->user()->id;
            $customer->save();
            return response()->json($customer->appraiser);
        }
    }

    public function update(CustomerRequest $request, Customer $customer) {
        $validated = $request->validated();
        $validated['info']['images']['saler'] = $validated['info']['images']['appraiser'] = [];
        $customer->update($validated);

        if (isset($request->info['images']['saler']) && count($request->info['images']['saler'])) {
            $files = [];
            for ($i=0; $i < count($request->info['images']['saler']); $i++) {
                array_push($files, 'info.images.saler.'.$i);
            }
            $customer->addMultipleMediaFromRequest($files)->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('saler_files');
            });
        }
        if (isset($request->info['images']['appraiser']) && count($request->info['images']['appraiser'])) {
            $files = [];
            for ($i=0; $i < count($request->info['images']['appraiser']); $i++) {
                array_push($files, 'info.images.appraiser.'.$i);
            }
            $customer->addMultipleMediaFromRequest($files)->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('appraiser_files');
            });
        }

        return redirect()->route('customers.index');
    }

    public function deleteMedia(Request $request, Customer $customer) {
        $customer->getMedia($request->collection_name)->find($request->file_id)->delete();
        return response()->noContent();
    }

    public function destroy(Customer $customer) {
        $this->authorize('delete', $customer);
        $customer->delete();
        return response()->noContent();
    }
}
