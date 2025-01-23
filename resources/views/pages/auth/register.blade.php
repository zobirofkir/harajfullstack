<x-app-layout title="تسجيل حساب جديد">
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white rounded-lg shadow-lg p-8">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <h2 class="text-center text-3xl font-extrabold text-gray-900">
                إنشاء حساب جديد
            </h2>

            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Account Type Selection -->
                <div class="mb-4">
                    <label for="account_type" class="block text-sm font-medium text-gray-700">نوع الحساب</label>
                    <div class="mt-2 flex items-center">
                        <input id="user" name="account_type" type="radio" value="مستخدم" required class="h-4 w-4 text-gray-800 focus:ring-gray-500 border-gray-300">
                        <label for="user" class="ml-2 text-sm text-gray-700">مستخدم</label>

                        <input id="buyer" name="account_type" type="radio" value="مشتري" required class="ml-4 h-4 w-4 text-gray-800 focus:ring-gray-500 border-gray-300">
                        <label for="buyer" class="ml-2 text-sm text-gray-700">مشتري</label>
                    </div>
                </div>

                @error('account_type')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="name" class="sr-only">الاسم الكامل</label>
                        <input id="name" name="name" type="text" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm"
                               placeholder="الاسم الكامل">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="email" class="sr-only">البريد الإلكتروني</label>
                        <input id="email" name="email" type="email" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm"
                               placeholder="البريد الإلكتروني">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="password" class="sr-only">كلمة المرور</label>
                        <input id="password" name="password" type="password" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm"
                               placeholder="كلمة المرور">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="password_confirmation" class="sr-only">تأكيد كلمة المرور</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-gray-500 focus:border-gray-500 focus:z-10 sm:text-sm"
                               placeholder="تأكيد كلمة المرور">
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-transform transform hover:scale-105">
                        تسجيل
                    </button>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        لديك حساب؟
                        <a href="{{ route('login') }}" class="text-gray-800 font-medium hover:underline">
                            دخول
                        </a>
                    </p>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
