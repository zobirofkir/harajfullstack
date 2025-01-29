<x-app-layout title="الرسائل">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold mb-6 text-gray-800 text-center">الرسائل</h1>

        <!-- Filter Input Form -->
        <div class="mb-6">
            <input id="filterInput" type="text" placeholder="ابحث عن محادثات"
                   class="w-full sm:w-80 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all duration-200" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Chats -->
            @if ($chats->isNotEmpty())
            @foreach ($chats as $chat)
                <div class="container mx-auto px-4 py-6">
                    <h1 class="text-2xl font-semibold mb-4 text-gray-700 text-center">{{ $chat->car->title }}</h1>

                    <div class="flex">
                        <div class="flex-1 bg-gray-50 p-4 rounded-lg shadow-lg h-[80vh] overflow-y-auto">
                            @foreach ($chat->messages as $message)
                                <div class="flex {{ Auth::id() === $message->user_id ? 'justify-end' : 'justify-start' }} mb-4">
                                    <div class="bg-gray-100 p-3 rounded-lg shadow-md w-3/4">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-gray-700 text-sm font-medium">
                                                {{ $message->user_id === Auth::id() ? 'You' : $message->user->name }}
                                            </span>
                                            <span class="text-gray-500 text-xs">
                                                {{ $message->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="text-gray-600 text-md">{{ $message->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

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
            @endforeach
        @else
            <p class="text-center text-gray-500 mt-6">لا توجد محادثات متاحة.</p>
        @endif

    </div>
    </div>

    <script>
        document.getElementById('filterInput').addEventListener('input', function() {
            const filterValue = this.value.toLowerCase();
            const userItems = document.querySelectorAll('.user-item');

            userItems.forEach(item => {
                const userName = item.querySelector('a').textContent.toLowerCase();
                if (userName.includes(filterValue)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>
