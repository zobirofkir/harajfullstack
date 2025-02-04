<?php

namespace App\Services\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
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

        return redirect()->route('index.login')->with('success', 'تم التسجيل بنجاح! يرجى تسجيل الدخول.');
    }

    public function indexLogin()
    {
        return view('pages.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']])) {
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

    public function updateProfileForm()
    {
        return view('pages.auth.update-profile');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->has('password') && $request->password) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(storage_path('app/public/'.$user->image))) {
                unlink(storage_path('app/public/'.$user->image));
            }

            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return back()->with('success', 'تم تحديث المعلومات بنجاح!');
    }
}
