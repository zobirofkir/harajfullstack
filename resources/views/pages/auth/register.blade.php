<x-app-layout title="تسجيل حساب جديد">
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white rounded-lg shadow-xl p-8">
            @if(session('success'))
                <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mb-4 p-4 bg-red-100 text-red-800 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <h2 class="text-center text-4xl font-extrabold text-gray-900 mb-6">
                إنشاء حساب جديد
            </h2>

            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Account Type Selection -->
                <div class="mb-6">
                    <label for="account_type" class="block text-sm font-medium text-gray-700">نوع الحساب</label>
                    <div class="mt-2 flex items-center gap-2">
                        <input id="user" name="account_type" type="radio" value="مستخدم" required class="h-5 w-5 text-gray-600 focus:ring-gray-500 border-gray-300">
                        <label for="user" class="mr-2 text-sm text-gray-700">مستخدم</label>

                        <input id="buyer" name="account_type" type="radio" value="مشتري" required class="h-5 w-5 text-gray-600 focus:ring-gray-500 border-gray-300">
                        <label for="buyer" class="ml-2 text-sm text-gray-700">تاجر</label>
                    </div>
                </div>

                @error('account_type')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="name" class="sr-only">الاسم الكامل</label>
                        <input id="name" name="name" type="text" required
                               class="appearance-none rounded-md block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                               placeholder="الاسم الكامل">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="email" class="sr-only">البريد الإلكتروني</label>
                        <input id="email" name="email" type="email" required
                               class="appearance-none rounded-md block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                               placeholder="البريد الإلكتروني">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="password" class="sr-only">كلمة المرور</label>
                        <input id="password" name="password" type="password" required
                               class="appearance-none rounded-md block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                               placeholder="كلمة المرور">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="password_confirmation" class="sr-only">تأكيد كلمة المرور</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="appearance-none rounded-md block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                               placeholder="تأكيد كلمة المرور">
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-6 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all ease-in-out duration-200 transform hover:scale-105">
                        تسجيل
                    </button>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        لديك حساب؟
                        <a href="{{ route('login') }}" class="text-gray-600 font-medium hover:underline">
                            دخول
                        </a>
                    </p>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
