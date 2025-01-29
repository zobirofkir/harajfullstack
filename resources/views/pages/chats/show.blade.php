<x-app-layout title="الدردشة">
    <div class="container mx-auto px-4 py-6">

        <!-- Alert Message -->
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg mb-6 text-center shadow-md" role="alert">
            <strong>تنبيه!</strong> يرجى زيارة قسم الدردشات لعرض الرسائل بينك وبين البائع بعد إرسال الرسالة.
        </div>

        <h1 class="text-2xl font-semibold mb-4 text-gray-700 text-center">{{ $chat->car->title }}</h1>

        <div class="flex">
            <!-- Chat Messages (right side) -->
            <div class="flex-1 bg-gray-50 p-4 rounded-lg shadow-lg h-[80vh] overflow-y-auto">
                @foreach ($messages as $index => $message)
                <div class="flex {{ Auth::check() && Auth::id() === $message->user_id ? 'justify-end' : 'justify-start' }} mb-6">
                    <div class="bg-gradient-to-r {{ Auth::check() && Auth::id() === $message->user_id ? 'from-green-400 to-green-500' : 'from-gray-100 to-gray-200' }} p-4 rounded-xl shadow-lg w-3/4 max-w-md">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-gray-800 text-sm font-semibold">
                                {{ $message->user_id === Auth::id() ? 'أنت' : $message->user->name }}
                            </span>
                            <span class="text-gray-500 text-xs italic">
                                {{ $message->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="p-2 bg-white rounded-lg shadow-inner">
                            <p class="text-gray-800 text-lg">{{ $message->content }}</p>
                        </div>
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
