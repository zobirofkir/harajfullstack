<?php

namespace App\Services\Constructors;

use App\Models\User;
use Illuminate\Http\Request;

interface PaymentConstructor
{
    public function activate(User $user);

    public function processPayment(Request $request);
}
