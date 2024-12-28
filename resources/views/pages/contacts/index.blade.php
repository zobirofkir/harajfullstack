<x-app-layout title="تواصل معنا">
    <div class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-2xl bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">
                تواصل معنا
            </h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('contacts.store') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-right text-gray-600 mb-2">
                        الاسم الكامل
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg text-right text-gray-700 p-4 focus:outline-none focus:ring-2 focus:ring-gray-300"
                        placeholder="أدخل اسمك الكامل"
                    />
                </div>
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-right text-gray-600 mb-2">
                        البريد الإلكتروني
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg text-right text-gray-700 p-4 focus:outline-none focus:ring-2 focus:ring-gray-300"
                        placeholder="أدخل بريدك الإلكتروني"
                    />
                </div>
                <!-- Phone Field -->
                <div>
                    <label for="phone" class="block text-right text-gray-600 mb-2">
                        رقم الهاتف
                    </label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        required
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg text-right text-gray-700 p-4 focus:outline-none focus:ring-2 focus:ring-gray-300"
                        placeholder="أدخل رقم هاتفك"
                    />
                </div>
                <!-- Message Field -->
                <div>
                    <label for="message" class="block text-right text-gray-600 mb-2">
                        الرسالة
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        rows="4"
                        required
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg text-right text-gray-700 p-4 focus:outline-none focus:ring-2 focus:ring-gray-300"
                        placeholder="أدخل رسالتك هنا"
                    ></textarea>
                </div>
                <!-- Submit Button -->
                <div class="text-center">
                    <button
                        type="submit"
                        class="w-full bg-gray-700 text-white font-bold rounded-lg px-6 py-4 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-400"
                    >
                        إرسال الرسالة
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
