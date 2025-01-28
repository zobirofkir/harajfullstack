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
            @foreach ($chats as $chat)
                @if ($chat->messages->isNotEmpty()) <!-- Ensure messages are not empty -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 user-item">
                        <!-- Display only the first message of each chat -->
                        @php $firstMessage = $chat->messages->first(); @endphp
                        @if ($firstMessage->user_id != Auth::id())
                            <div class="flex items-start space-x-4 mb-5">
                                <img src="{{ $firstMessage->user->image ? asset('storage/' . $firstMessage->user->image) : 'https://icons.iconarchive.com/icons/icons8/windows-8/512/Users-Guest-icon.png' }}"
                                     alt="User Avatar"
                                     class="w-12 h-12 rounded-full object-cover ml-4">
                                <div class="flex flex-col space-y-2">
                                    <a href="{{ route('chats.show', ['userName' => $firstMessage->user->name, 'carId' => $chat->car_id]) }}"
                                       class="text-lg font-semibold text-gray-800 hover:text-gray-600 transition-all duration-200">
                                        {{ $firstMessage->user->name }}
                                    </a>
                                    <p class="text-sm text-gray-600">{{ $firstMessage->content }}</p>
                                    <!-- Created At -->
                                    <p class="text-xs text-gray-400">{{ $firstMessage->created_at->format('M d, Y \a\t h:i A') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
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
