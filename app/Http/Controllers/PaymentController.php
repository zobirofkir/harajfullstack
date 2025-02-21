<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Facades\PaymentFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function activate(User $user)
    {
        return PaymentFacade::activate($user);
    }

    public function showPaymentForm()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        return PaymentFacade::processPayment($request);
    }
}
