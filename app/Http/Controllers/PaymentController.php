<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(PaymentRequest $request, Customer $customer) {
        $customer->payments()->create($request->validated() + [
            'user_id' => $request->user()->id
        ]);
        return response()->noContent();
    }

    public function update(Request $request, Customer $customer, Payment $payment) {
        $payment->update($request->validated());
        return response()->noContent();
    }
}
