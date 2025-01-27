<x-app-layout title="الرسائل">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4 text-gray-700 text-center">الرسائل</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Left: User List -->
            <div class="bg-white p-4 rounded-lg shadow-lg col-span-1 h-full overflow-y-auto">
                <h2 class="text-lg font-bold text-gray-700 mb-4">المستخدمون الذين أرسلوا لي رسائل</h2>
                <!-- User List -->
                <div class="overflow-y-auto space-y-4">
                    @foreach ($chats as $chat)
                        @foreach ($chat->messages as $message)
                            @if($message->user_id != Auth::id()) 
                                <div class="flex items-center space-x-3">
                                    <img src="{{ $message->user->image ? asset('storage/' . $message->user->image) : 'https://icons.iconarchive.com/icons/icons8/windows-8/512/Users-Guest-icon.png' }}"
                                         alt="User Avatar"
                                         class="w-10 h-10 rounded-full ml-4">
                                    <a href="{{ route('chats.show', ['userName' => $message->user->name, 'carId' => $chat->car_id]) }}"
                                       class="text-gray-700 font-medium hover:text-blue-600">
                                        {{ $message->user->name }}
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
