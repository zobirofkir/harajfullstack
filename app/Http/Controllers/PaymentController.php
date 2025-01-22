<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Facades\PaymentFacade;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function activate(User $user)
    {
        return PaymentFacade::activate($user);
    }

    public function paymentCallback(Request $request)
    {
        return PaymentFacade::paymentCallback($request);
    }
}
