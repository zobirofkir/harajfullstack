<x-app-layout title="تسجيل الدخول">
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">
                تسجيل الدخول
            </h2>
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                    <input id="email" name="email" type="email" required autofocus
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-500 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                           placeholder="البريد الإلكتروني" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                    <input id="password" name="password" type="password" required
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-500 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                           placeholder="كلمة المرور">
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        تسجيل الدخول
                    </button>
                </div>
                @if (session('error'))
                    <p class="text-red-500 text-sm mt-4 text-center">{{ session('error') }}</p>
                @endif
            </form>

            <!-- روابط التسجيل واستعادة كلمة المرور -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    ليس لديك حساب؟
                    <a href="{{ route('register') }}" class="text-gray-800 font-medium hover:underline">
                        إنشاء حساب جديد
                    </a>
                </p>
                <p class="text-sm text-gray-600 mt-4">
                    نسيت كلمة المرور؟
                    <a href="{{ route('index.forgot-password') }}" class="text-gray-800 font-medium hover:underline">
                        استعادة كلمة المرور
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
