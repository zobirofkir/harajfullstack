<?php

namespace App\Services\Services;

use App\Models\User;
use App\Services\Constructors\PaymentConstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentService implements PaymentConstructor
{
    public function activate(User $user)
    {
        $selectedPlan = $user->plan;

        return view('moyassar.packs', compact('selectedPlan'));
    }

    public function paymentCallback(Request $request)
    {
        $paymentStatus = $request->query('status');
        $plan = $request->query('plan');

        if (! $paymentStatus || ! $plan) {
            return back()->with('error', 'البيانات المطلوبة مفقودة.');
        }

        if ($paymentStatus === 'paid') {
            $user = Auth::user();
            if ($user) {
                $user->update(['plan' => $plan]);

                return redirect('/')->with('success', 'تم تحديث خطتك بنجاح.');
            }
        }

        return back()->with('error', 'حالة الدفع غير ناجحة.');
    }
}
