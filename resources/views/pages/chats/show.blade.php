<x-app-layout title="الدردشة">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4 text-gray-700">{{ $chat->car->title }}</h1>

        <!-- Chat Messages -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-md max-h-96 overflow-y-auto mb-6">
            @foreach($messages as $message)
                <div class="flex items-start mb-4">
                    <div class="bg-white p-3 rounded-lg shadow-sm w-full">
                        <p class="text-gray-700 text-sm mb-2">{{ $message->content }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 text-xs">{{ $message->created_at->diffForHumans() }}</span>
                            <span class="text-gray-600 text-xs font-semibold">{{ $chat->car->user->name }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Send Message Form -->
        <form action="{{ route('chats.send', $chat) }}" method="POST" class="flex flex-col space-y-4">
            @csrf
            <textarea name="content" rows="3" placeholder="اكتب رسالتك هنا..." class="p-4 border border-gray-300 rounded-lg w-full text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500" required></textarea>
            <button type="submit" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                إرسال
            </button>
        </form>
    </div>
</x-app-layout>
