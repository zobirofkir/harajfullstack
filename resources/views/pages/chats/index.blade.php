<x-app-layout title="الدردشات">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4 text-gray-700">الدردشات الخاصة بك</h1>
        @auth
            <ul class="space-y-4">
                @foreach($chats as $chat)
                    <a href="{{ route('chats.show', ['userName' => $chat->username, 'carId' => $chat->car_id]) }}" class="text-lg font-medium text-blue-600 hover:underline">
                        {{ $chat->car->title }}
                    </a>
                @endforeach
            </ul>
        @else
            <p class="text-gray-700">يرجى تسجيل الدخول للوصول إلى الدردشات.</p>
        @endauth
    </div>
</x-app-layout>
