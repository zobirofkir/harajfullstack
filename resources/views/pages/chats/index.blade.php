<x-app-layout title="الرسائل">
    <div class="flex bg-gray-100 min-h-screen">
        <!-- Full-Width Conversations List -->
        <div class="w-full bg-white shadow-lg border-r p-6 overflow-y-auto">
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">المحادثات</h2>

            <!-- Search Input -->
            <div class="relative mb-6">
                <input id="filterInput" type="text" placeholder="🔍 ابحث عن المحادثات"
                    class="w-full px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm text-gray-700 placeholder-gray-400 transition-all duration-300 ease-in-out" />
            </div>

            <!-- User Cards Grid -->
            <div id="usersGrid" class="space-y-4">
                @foreach ($conversationsWithUsers as $carId => $conversation)
                    @foreach ($conversation['senders'] as $sender)
                        @php
                            $latestMessage = $conversation['messages']->where('user_id', $sender->id)->first();
                            $car = $latestMessage && $latestMessage->chat && $latestMessage->chat->car ? $latestMessage->chat->car : null;
                            $carTitle = $car ? $car->title : 'بدون عنوان';
                            $carImage = $car && is_array($car->images) && count($car->images) > 0 ? $car->images[0] : 'default-car.jpg';
                        @endphp
                        <a href="{{ route('chats.start', ['userName' => $sender->name, 'carId' => $carId]) }}" class="block">
                            <div class="user-card p-4 bg-white rounded-lg shadow-md hover:shadow-lg cursor-pointer transition-all duration-300 ease-in-out transform hover:scale-[1.02]">
                                <div class="flex items-center space-x-4 gap-4">
                                    <!-- User Avatar -->
                                    <div class="flex-shrink-0">
                                        <img src="{{ $sender->image ? asset('storage/' . $sender->image) : 'https://ui-avatars.com/api/?name=' . urlencode($sender->name) }}" alt="User"
                                            class="w-12 h-12 rounded-full object-cover border-2 border-blue-500 shadow-sm" />
                                    </div>

                                    <!-- User Details -->
                                    <div class="flex-1 min-w-0">
                                        <p class="text-lg font-semibold text-gray-800 truncate">{{ $sender->name }}</p>
                                        <p class="text-sm text-gray-500 truncate">{{ $latestMessage ? Str::limit($latestMessage->content, 20) : 'لا توجد رسائل' }}</p>
                                    </div>

                                    <!-- Car Details -->
                                    <div class="flex-shrink-0 text-right">
                                        <p class="text-sm text-blue-600 font-medium">🚗 {{ $carTitle }}</p>
                                        <p class="text-xs text-gray-500">{{ $latestMessage ? $latestMessage->created_at->diffForHumans() : 'لا توجد رسائل' }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.getElementById('filterInput').addEventListener('input', function(event) {
            let filterValue = event.target.value.toLowerCase();
            let userCards = document.querySelectorAll('.user-card');

            userCards.forEach(function(card) {
                let userNameElement = card.querySelector('.text-lg');
                if (userNameElement) {
                    let userName = userNameElement.innerText.toLowerCase();
                    card.style.display = userName.includes(filterValue) ? '' : 'none';
                }
            });
        });
    </script>
</x-app-layout>
