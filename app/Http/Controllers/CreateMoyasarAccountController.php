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
            // التحقق من وجود القيم المطلوبة
            $paymentStatus = $request->query('status');
            $paymentId = $request->query('id');

            if (!$paymentStatus || !$paymentId) {
                return redirect()->back()->with('error', 'البيانات المطلوبة مفقودة. يرجى المحاولة مرة أخرى.');
            }

            // التحقق من حالة الدفع
            if ($paymentStatus === 'paid') {
                $userId = Auth::id();

                if (!$userId) {
                    return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول لتفعيل الحساب.');
                }

                $user = User::find($userId);
                if ($user) {
                    $user->update(['is_active' => true]);
                    return redirect()->back()->with('success', 'تم تفعيل حسابك بنجاح!');
                }

                return redirect()->back()->with('error', 'لم يتم العثور على المستخدم.');
            }

            // إذا كانت حالة الدفع غير ناجحة
            return redirect()->back()->with('error', 'حدث خطأ أثناء معالجة الدفع. يرجى التحقق من معلومات الدفع.');
        } catch (\Exception $e) {
            // تسجيل الخطأ للتصحيح
            Log::error('Payment Callback Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى لاحقًا.');
        }
    }
}
