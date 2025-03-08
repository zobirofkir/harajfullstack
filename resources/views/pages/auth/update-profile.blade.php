<x-app-layout>
    <div class="max-w-2xl mx-auto mt-6 bg-white p-6 rounded-lg shadow-md my-[100px] mt-[100px]">
        <h2 class="text-2xl font-semibold text-center mb-6">تحديث الملف الشخصي</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">الاسم</label>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور الجديدة (اختياري)</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">تأكيد كلمة المرور</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Profile Image -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">صورة الملف الشخصي (اختياري)</label>
                <input type="file" id="image" name="image" class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 text-center">
                <button type="submit" class="px-6 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
