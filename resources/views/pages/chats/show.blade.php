<x-app-layout title="الدردشة">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4 text-gray-700 text-center">{{ $chat->car->title }}</h1>

        <!-- Layout for User and Chat -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 h-[80vh]">
            <!-- Left: User Info -->
            <div x-data="{ open: true }" class="bg-white p-4 rounded-lg shadow-lg col-span-1 h-full overflow-y-auto transition-all duration-500 ease-in-out">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-bold text-gray-700 mb-4">المستخدم</h2>
                    <button @click="open = !open" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9l6 6 6-6"></path>
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>
                <!-- User List -->
                <div x-show="open" class="overflow-y-auto space-y-4">
                    @foreach ($messages->unique('user_id') as $message)
                        <div class="flex items-center space-x-3">
                            <img src="{{ $message->user->image ? asset('storage/' . $message->user->image) : 'https://icons.iconarchive.com/icons/icons8/windows-8/512/Users-Guest-icon.png' }}"
                                 alt="User Avatar"
                                 class="w-10 h-10 rounded-full ml-4">
                            <a href="{{ route('chats.show', ['userName' => $message->username, 'carId' => $chat->car_id]) }}"
                               class="text-gray-700 font-medium hover:text-blue-600">
                                {{ $message->username }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right: Chat and Form -->
            <div class="col-span-1 md:col-span-3 flex flex-col justify-between bg-gray-50 p-4 rounded-lg shadow-lg h-full overflow-hidden">
                @if(isset($chat) && $chat->messages->isNotEmpty())
                    <!-- Chat Messages -->
                    <div class="overflow-y-auto mb-4 space-y-4 flex-grow">
                        @foreach($messages as $message)
                            <div class="flex items-start {{ Auth::check() && Auth::id() === $message->user_id ? 'justify-end' : '' }}">
                                <div class="{{ Auth::check() && Auth::id() === $message->user_id ? 'bg-blue-100' : 'bg-white' }} p-3 rounded-lg shadow-md w-3/4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-gray-700 text-sm font-medium">{{ $message->username }}</span>
                                        <span class="text-gray-500 text-xs">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-600 text-md bg-gray-200 px-2 py-1 rounded">{{ $message->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Send Message Form -->
                    @auth
                        <form action="{{ route('chats.send', $chat) }}" method="POST" class="flex space-x-4">
                            @csrf
                            <textarea name="content" rows="2" placeholder="اكتب رسالتك هنا..."
                                      class="flex-grow px-1 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                                      required></textarea>
                            <button type="submit"
                                    class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                إرسال
                            </button>
                        </form>
                    @else
                        <p class="text-gray-700">يرجى تسجيل الدخول لإرسال رسالة.</p>
                    @endauth
                @else
                    <!-- If no messages, display a placeholder -->
                    <div class="flex items-center justify-center bg-gray-100 p-4 rounded-lg">
                        <p class="text-gray-500">لا توجد رسائل بعد. اختر مستخدمًا للبدء.</p>
                    </div>
                @endif
            </div>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</x-app-layout>
