<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateMoyasarAccountController extends Controller
{
    // عرض صفحة خطط الدفع
    public function activate(User $user)
    {
        return view('moyassar.packs');
    }

    // معالجة رد الدفع (Callback)
    public function handlePaymentCallback(Request $request)
    {
        // استلام بيانات الدفع
        $paymentStatus = $request->query('status'); // حالة الدفع
        $paymentId = $request->query('id'); // معرف الدفع
        $userId = Auth::id(); // معرف المستخدم الحالي (إذا كان تسجيل الدخول مطلوبًا)

        // التحقق من حالة الدفع
        if ($paymentStatus === 'paid') {
            // تحديث حالة المستخدم وتفعيل الحساب
            $user = User::find($userId);
            if ($user) {
                $user->update(['is_active' => true]); // تحديث حالة الحساب إلى مفعّل
            }

            // إعادة توجيه مع رسالة نجاح
            return redirect()->route('home')->with('success', 'تم تفعيل حسابك بنجاح!');
        }

        // إعادة توجيه مع رسالة خطأ إذا فشل الدفع
        return redirect()->route('home')->with('error', 'حدث خطأ أثناء معالجة الدفع.');
    }
}
