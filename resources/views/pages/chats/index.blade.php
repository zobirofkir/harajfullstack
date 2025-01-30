<x-app-layout title="الرسائل">
    <div class="flex bg-gray-100 min-h-screen">
        <div class="w-full bg-white shadow-xl border-r p-6 overflow-y-auto flex flex-col space-y-6">
            <h2 class="text-3xl font-semibold text-gray-900 text-center mb-8">المحادثات</h2>

            <!-- Search Input -->
            <div class="relative mb-8">
                <input id="filterInput" type="text" placeholder="🔍 ابحث عن المحادثات"
                    class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-md text-gray-700 placeholder-gray-500 transition-all duration-300 ease-in-out" />
            </div>

            <!-- User Cards Grid -->
            <div id="usersGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($conversationsWithUsers as $carId => $conversation)
                    @foreach ($conversation['senders'] as $sender)
                        <div class="user-card p-5 bg-white rounded-lg shadow-md hover:bg-blue-50 cursor-pointer transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl user-card-item">
                            <a href="{{ route('chats.start', ['userName' => $sender->name, 'carId' => $carId]) }}">
                                <div class="flex items-center space-x-4">
                                    <!-- User Profile Image (Optional) -->
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($sender->name) }}" alt="User" class="w-12 h-12 rounded-full object-cover" />
                                    <div class="text-center flex-1">
                                        <span class="block text-xl font-semibold text-gray-800">{{ $sender->name }}</span>
                                        <span class="block text-xs text-gray-600 mt-1">آخر رسالة: {{ $conversation['messages']->where('user_id', $sender->id)->first()->created_at->diffForHumans() }}</span>
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
            let userCards = document.querySelectorAll('.user-card-item');

            userCards.forEach(function(card) {
                let userNameElement = card.querySelector('.text-xl');

                if (userNameElement) {
                    let userName = userNameElement.innerText.toLowerCase();

                    if (userName.includes(filterValue)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>

</x-app-layout>
