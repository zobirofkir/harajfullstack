<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateMoyasarAccountController extends Controller
{
    public function activate(User $user)
    {
        return view('moyassar.packs');
    }

    public function handlePaymentCallback(Request $request)
    {
        $paymentStatus = $request->query('status');
        $paymentId = $request->query('id');
        $userId = Auth::id();

        if ($paymentStatus === 'paid') {
            $user = User::find($userId);
            if ($user) {
                $user->update(['is_active' => true]);
            }

            return redirect()->route('home')->with('success', 'تم تفعيل حسابك بنجاح!');
        }

        return redirect()->route('home')->with('error', 'حدث خطأ أثناء معالجة الدفع.');
    }
}
