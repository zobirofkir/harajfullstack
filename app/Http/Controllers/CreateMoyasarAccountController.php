<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreateMoyasarAccountController extends Controller
{
    public function activate(User $user)
    {
        return view('moyassar.packs');
    }

    public function handlePaymentCallback(Request $request)
    {
        try {
            $paymentStatus = $request->query('status');
            $paymentId = $request->query('id');

            if (!$paymentStatus || !$paymentId) {
                return back()->with('error', 'البيانات المطلوبة مفقودة.');
            }

            if ($paymentStatus === 'paid') {
                $user = Auth::user();
                if ($user) {
                    $user->update(['is_active' => true]);
                    return redirect('/admin')->with('success', 'تم تفعيل حسابك بنجاح.');
                }
            }
            return back()->with('error', 'حالة الدفع غير ناجحة.');
        } catch (\Exception $e) {
            Log::error('Payment Callback Error: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ غير متوقع.');
        }
    }
}
