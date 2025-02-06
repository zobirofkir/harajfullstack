<x-app-layout title="{{ config('app.name') }}">

    <div class="container mx-auto flex justify-center mt-10">

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex items-center justify-between" role="alert">
                <div>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (Auth::check() && !Auth::user()->is_active_user)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex items-center justify-between md:flex flex-col text-center" role="alert">
                <div>
                    <strong class="font-bold">تنبيه!</strong>
                    <span class="block sm:inline">حسابك غير مفعل. يرجى إدخال رمز التحقق المرسل إلى بريدك الإلكتروني لتفعيله.</span>
                </div>
                <a href="{{ route('verify.otp') }}" class="ml-4 text-black font-bold py-2 px-4 rounded">
                    تفعيل الحساب
                </a>
            </div>
        @endif
    </div>

    <div>
        @include('components.cars')
    </div>

    {{-- @if (Auth::check() && Auth::user()->account_type === 'مشتري')
        <section class="flex justify-center">
            @include('components.plan')
        </section>
    @else

    @endif --}}

</x-app-layout>
