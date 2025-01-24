<x-app-layout title="نسيت كلمة المرور">
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-center text-3xl font-extrabold text-orange-900">
                نسيت كلمة المرور
            </h2>
            <p class="mt-2 text-center text-sm text-orange-600">
                أدخل بريدك الإلكتروني لإعادة تعيين كلمة المرور.
            </p>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('forgot-password') }}">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">البريد الإلكتروني</label>
                        <input id="email" name="email" type="email" required
                               class="appearance-none rounded relative block w-full px-3 py-2 border border-orange-300 placeholder-orange-500 text-orange-900 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm"
                               placeholder="البريد الإلكتروني">
                    </div>
                </div>
                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-orange-800 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-transform transform hover:scale-105">
                        إرسال رابط إعادة تعيين كلمة المرور
                    </button>
                </div>
            </form>

            @if (session('success'))
                <p class="text-green-500 text-sm mt-4 text-center">{{ session('success') }}</p>
            @endif

            @if (session('status'))
                <div class="mt-4 bg-green-100 text-green-700 p-4 rounded">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
