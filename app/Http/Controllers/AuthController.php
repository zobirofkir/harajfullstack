<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        if ($user->role == 'user') {
            return redirect('/');
        } else if($user->role == 'supplier') {
            return redirect('/admin');
        }

        return redirect()->route('index.login')->with('success', 'تم التسجيل بنجاح! يرجى تسجيل الدخول.');
    }

    public function indexLogin()
    {
        return view('pages.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح!');
        }

        return back()->with('error', 'بيانات الدخول غير صحيحة. حاول مرة أخرى.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('index.login')->with('success', 'تم تسجيل الخروج بنجاح.');
    }


    public function indexForgotPassword()
    {
        return view('pages.auth.forget-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني!');
        }

        return back()->with('error', 'تعذر إرسال رابط إعادة تعيين كلمة المرور. حاول مرة أخرى.');
    }

    public function showResetPasswordForm($token)
    {
        return view('pages.auth.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('index.login')->with('success', 'تم إعادة تعيين كلمة المرور بنجاح!');
        }

        return back()->with('error', 'فشل في إعادة تعيين كلمة المرور. حاول مرة أخرى.');
    }
}
