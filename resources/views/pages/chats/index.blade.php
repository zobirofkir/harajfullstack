<x-app-layout title="الرسائل">
    <div class="flex bg-gray-50">
        <div class="w-full bg-white shadow-lg border-r p-6 overflow-y-auto flex flex-col space-y-6">
            <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">المحادثات</h2>

            <!-- Search Input -->
            <div class="relative mb-6">
                <input id="filterInput" type="text" placeholder="🔍 ابحث عن المحادثات"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm text-gray-700 placeholder-gray-400 transition-all duration-300 ease-in-out" />
            </div>

            <!-- User Cards Grid -->
            <div id="usersGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($conversationsWithUsers as $carId => $conversation)
                    @foreach ($conversation['senders'] as $sender)
                        <div class="user-card p-5 bg-white rounded-lg shadow-lg hover:bg-blue-50 cursor-pointer transition-all duration-300 ease-in-out transform hover:scale-105 user-card-item">
                            <a href="{{ route('chats.start', ['userName' => $sender->name, 'carId' => $carId]) }}">
                                <div class="text-center">
                                    <span class="block text-lg font-semibold text-gray-800">{{ $sender->name }}</span>
                                    <span class="block text-xs text-gray-500 mt-1">آخر رسالة: {{ $conversation['messages']->where('user_id', $sender->id)->first()->created_at->diffForHumans() }}</span>
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
                let userName = card.querySelector('.text-lg').innerText.toLowerCase();

                if (userName.includes(filterValue)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>
