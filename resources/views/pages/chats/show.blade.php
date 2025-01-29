<x-app-layout title="الدردشة">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4 text-gray-700 text-center">{{ $chat->car->title }}</h1>

        <div class="flex">
            <!-- Chat Messages (right side) -->
            <div class="flex-1 bg-gray-50 p-4 rounded-lg shadow-lg h-[80vh] overflow-y-auto">
                @foreach ($messages as $message)
                    <div class="flex {{ Auth::check() && Auth::id() === $message->user_id ? 'justify-end' : 'justify-start' }} mb-4">
                        <div class="bg-gray-100 p-3 rounded-lg shadow-md w-3/4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-700 text-sm font-medium">
                                    {{ $message->user_id === Auth::id() ? 'You' : $message->user->name }}
                                </span>
                                <span class="text-gray-500 text-xs">
                                    {{ $message->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <!-- Message Content -->
                            <p class="text-gray-600 text-md">{{ $message->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- Send Message Form -->
        @auth
            <form action="{{ route('chats.send', $chat) }}" method="POST" class="flex space-x-4 mt-4">
                @csrf
                <textarea name="content" rows="2" placeholder="اكتب رسالتك هنا..."
                          class="flex-grow px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                          required></textarea>
                <button type="submit" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    إرسال
                </button>
            </form>
        @else
            <p class="text-gray-700 mt-4">يرجى تسجيل الدخول لإرسال رسالة.</p>
        @endauth
    </div>
</x-app-layout>
