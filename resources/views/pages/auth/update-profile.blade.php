<x-app-layout>
    <div class="max-w-2xl mx-auto mt-6 bg-white p-6 rounded-lg shadow-md my-[100px] mt-[100px]">
        <h2 class="text-2xl font-semibold text-center mb-6">تحديث الملف الشخصي</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">الاسم</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Profile Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">الصورة الشخصية</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full">
                @if(auth()->user()->image)
                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile" class="mt-2 h-20 w-20 rounded-full object-cover">
                @endif
            </div>

            <!-- Cover Photo -->
            <div>
                <label for="cover_photo" class="block text-sm font-medium text-gray-700">صورة الغلاف</label>
                <input type="file" name="cover_photo" id="cover_photo" class="mt-1 block w-full">
                @if(auth()->user()->cover_photo)
                    <img src="{{ asset('storage/' . auth()->user()->cover_photo) }}" alt="Cover" class="mt-2 h-32 w-full object-cover rounded-lg">
                @endif
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور الجديدة (اختياري)</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
