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

    public function paymentCallback(Request $request)
    {
        $plan = $request->get('plan');

        if ($plan) {
            $user = Auth::user();

            if ($user) {
                $user->update(['plan' => $plan]);

                return redirect('/admin')->with('success', 'تم تحديث خطتك بنجاح');
            }
        }

        return redirect('/admin')->with('error', 'الدفع غير ناجح أو رد الاتصال غير صالح');
    }
}
