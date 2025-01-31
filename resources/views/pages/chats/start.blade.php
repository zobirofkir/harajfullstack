<x-app-layout title="محادثة مع {{ optional($user)->name }}">
    <div class="container mx-auto p-6 max-w-3xl">
        <!-- Header Section -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">{{ optional($user)->name }}</h1>
            <div class="flex items-center space-x-3">
                <button class="text-gray-600 hover:text-gray-800 focus:outline-none transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- User List -->
        <div class="bg-gray-50 shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">المستخدمين الذين اختاروا هذه السيارة</h2>
            <ul class="space-y-4">
                @foreach ($users as $user)
                    <li class="flex items-center justify-between p-4 border-b border-gray-200 hover:bg-gray-100 transition">
                        <div class="flex gap-4 items-center space-x-3">
                            <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-white text-lg font-semibold">
                                {{ strtoupper($user->name[0]) }}
                            </div>
                            <span class="text-gray-900 text-lg">{{ $user->name }}</span>
                        </div>
                        <a href="{{ route('chats.start', ['userName' => $user->name, 'carId' => $car->id]) }}" class="text-blue-600 hover:text-blue-800 transition">ابدأ المحادثة</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Chat Box -->
        <div class="bg-gray-50 shadow-md rounded-lg p-6 h-96 overflow-y-auto mb-6 flex flex-col-reverse" id="chat-box">
            <ul class="space-y-4">
                @foreach ($messages as $message)
                    <li class="flex gap-4 items-start {{ $message->user_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                        @if($message->user_id !== Auth::id())
                            <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-white text-lg font-semibold">
                                {{ strtoupper($message->user->name[0]) }}
                            </div>
                        @endif

                        <div class="max-w-lg p-4 rounded-lg shadow-md text-sm {{ $message->user_id === Auth::id() ? 'bg-blue-600 text-white' : 'bg-white text-gray-900' }} relative">
                            <p>{{ $message->content }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Message Input -->
        <form method="POST" action="{{ route('chats.send', $chat) }}" class="flex items-center bg-white shadow-md rounded-lg p-4">
            @csrf
            <input type="text" name="content" class="flex-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none text-gray-800 placeholder-gray-400 transition" placeholder="اكتب رسالتك..." required>
            <button type="submit" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 focus:outline-none transition ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </form>
    </div>
</x-app-layout>
