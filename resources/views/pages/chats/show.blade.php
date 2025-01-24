<x-app-layout title="الدردشة">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4 text-gray-700">{{ $chat->car->title }}</h1>

        <!-- Chat Messages -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-lg max-h-96 overflow-y-auto mb-6 space-y-4">
            @foreach($messages as $message)
                <div class="flex items-start justify-center {{ Auth::check() && Auth::id() === $message->user_id ? 'justify-end' : '' }}">
                    <div class="{{ Auth::check() && Auth::id() === $message->user_id ? 'bg-blue-100' : 'bg-white' }} p-3 rounded-lg shadow-md w-4/5">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-700 text-sm font-medium">{{ $message->username }}</span>
                            <span class="text-gray-500 text-xs">{{ $message->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-600 text-md bg-gray-200 px-2 py-1 rounded">{{ $message->content }}</p>
                        @if(Auth::check() && Auth::id() === $message->user_id)
                            <form action="{{ route('messages.delete', $message) }}" method="POST" class="mt-2 text-right">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 text-xs hover:underline">حذف</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Send Message Form -->
        @auth
            <form action="{{ route('chats.send', $chat) }}" method="POST" class="flex flex-col space-y-4">
                @csrf
                <textarea name="content" rows="3" placeholder="اكتب رسالتك هنا..." class="p-4 border border-gray-300 rounded-lg w-full text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500" required></textarea>
                <button type="submit" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    إرسال
                </button>
            </form>
        @else
            <p class="text-gray-700">يرجى تسجيل الدخول لإرسال رسالة.</p>
        @endauth
    </div>
</x-app-layout>
