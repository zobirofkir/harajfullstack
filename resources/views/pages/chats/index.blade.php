<x-app-layout title="الرسائل">
    <div class="flex bg-gray-100 min-h-screen">
        <div class="w-full bg-white shadow-lg border-r p-6 overflow-y-auto flex flex-col space-y-6">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-6">المحادثات</h2>

            <!-- Search Input -->
            <div class="relative container mx-auto">
                <input id="filterInput" type="text" placeholder="🔍 ابحث عن المحادثات"
                    class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow text-gray-700 placeholder-gray-500 transition-all duration-300 ease-in-out" />
            </div>

            <!-- User Cards Grid -->
            <div id="usersGrid" class="flex flex-col gap-6 container mx-auto">
                @foreach ($conversationsWithUsers as $carId => $conversation)
                    @foreach ($conversation['senders'] as $sender)
                        @php
                            $latestMessage = $conversation['messages']->where('user_id', $sender->id)->first();
                            $car = $latestMessage && $latestMessage->chat && $latestMessage->chat->car ? $latestMessage->chat->car : null;
                            $carTitle = $car ? $car->title : 'بدون عنوان';
                            $carImage = $car && is_array($car->images) && count($car->images) > 0 ? $car->images[0] : 'default-car.jpg';
                        @endphp
                        <div class="user-card p-5 bg-white rounded-xl shadow-lg hover:shadow-2xl cursor-pointer transition-all duration-300 ease-in-out transform hover:scale-105">
                            <a href="{{ route('chats.start', ['userName' => $sender->name, 'carId' => $carId]) }}" class="block">
                                <div class="flex flex-row items-center gap-4 justify-between w-full">

                                    <div class="md:max-w-[20%] max-w-[30%] md:max-h-[20%] max-h-[30%] md:min-w-[20%] min-w-[30%] md:min-h-[20%] min-h-[30%] flex  flex-col items-center gap-4 justify-start">

                                        <!-- صورة المستخدم -->
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($sender->name) }}" alt="User"
                                            class="w-full h-full rounded-full object-cover border-2 border-blue-500 shadow-md" />
                                            
                                    </div>

                                    <div class="md:block hidden">
                                        <div class="flex flex-col gap-4 justify-center items-center">
                                            <span class="block text-lg font-semibold text-gray-800">{{ $sender->name }}</span>
                                            <span class="block text-lg font-semibold text-gray-800">{{ $sender->email }}</span>
                                            <span class="block text-lg font-semibold text-gray-800">{{ $latestMessage ? Str::limit($latestMessage->content, 10) : 'لا توجد رسائل' }}</span>
                                        </div>
                                    </div>

                                    <!-- صورة السيارة -->
                                    <div class="md:max-w-[20%] max-w-[50%] md:max-h-[20%] max-h-[50%] md:min-w-[20%] min-w-[50%] md:min-h-[20%] min-h-[50%] flex flex-col gap-4 items-center justify-center">
                                        <span class="block text-md text-blue-600 font-medium mt-1">🚗 {{ $carTitle }}</span>

                                        <img src="{{ asset('storage/' . $carImage) }}" alt="Car Image"
                                        class="w-full h-full rounded-lg object-cover border-2 border-gray-300" />

                                        <span class="block text-xs text-gray-600 mt-1 text-center">📩 {{ $latestMessage ? $latestMessage->created_at->diffForHumans() : 'لا توجد رسائل' }}</span>
                                    </div>

                                </div>
                            </a>
                        </div>
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
