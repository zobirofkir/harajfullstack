<?php

namespace App\Services\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Models\User;
use App\Services\Constructors\AuthConstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthService implements AuthConstructor
{
    public function index()
    {
        return view('pages.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $validated['image'] = $imagePath;
        }

        User::create($validated);

        return redirect()->route('index.login');
    }

    public function indexLogin()
    {
        return view('pages.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($field, $credentials['login'])->first();

        if ($user && Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']])) {

            return redirect()->route('home');
        }

        return back()->with('error', 'بيانات الدخول غير صحيحة. حاول مرة أخرى.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('index.login');
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

    public function showOtpForm()
    {
        if (Auth::user()->is_active_user) {
            return redirect()->route('home')->with('success', 'تم تفعيل حسابك بنجاح!');
        }

        return view('pages.auth.verify-otp');
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        $request->validated();

        if (Auth::user() && OtpService::verifyOtp(Auth::user(), Auth::user()->otp)) {
            Auth::user()->update([
                'is_active_user' => true,
                'otp' => null,
                'otp_expires_at' => null,
            ]);

            return redirect('/')->with('success', 'تم تفعيل حسابك بنجاح!');
        }

        return redirect('/')->with('error', 'رمز التحقق غير صحيح، يرجى المحاولة مرة أخرى.');
    }

    public function resendOtp(Request $request)
    {
        $user = User::where('email', Auth::user()->email)->first();

        OtpService::generateOtp($user);

        return response()->json(['success' => true, 'message' => 'تم إرسال الرمز الجديد.']);
    }
}
