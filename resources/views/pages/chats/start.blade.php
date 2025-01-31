<x-app-layout title="محادثة مع {{ $user->name }}">
    <div class="container mx-auto p-6 max-w-2xl">
        <!-- Header Section -->
        <div class="flex items-center justify-between bg-white shadow-md rounded-lg p-4 mb-4">
            <h1 class="text-lg font-semibold text-gray-900">محادثة مع {{ $user->name }}</h1>
        </div>

        <!-- Chat Box -->
        <div class="bg-gray-100 shadow-md rounded-lg p-4 h-96 overflow-y-auto mb-4 flex flex-col-reverse" id="chat-box">
            <ul class="space-y-4">
                @foreach ($messages as $message)
                    <li class="flex items-start {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        @if($message->user_id !== auth()->id())
                            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-white font-semibold">
                                {{ strtoupper($message->user->name[0]) }}
                            </div>
                        @endif

                        <div class="max-w-xs p-3 rounded-lg shadow-md text-sm {{ $message->user_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-white text-gray-900' }}">
                            <p>{{ $message->content }}</p>
                            <div class="text-xs text-gray-400 mt-1 text-left">{{ $message->created_at->diffForHumans() }}</div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Message Input -->
        <form method="POST" action="{{ route('chats.send', $user->id) }}" class="flex items-center bg-white shadow-md rounded-lg p-2">
            @csrf
            <input type="text" name="content" class="flex-1 p-3 border-none focus:ring-0 focus:outline-none text-gray-800 placeholder-gray-400" placeholder="اكتب رسالتك..." required>
            <button type="submit" class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700 focus:outline-none transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </form>
    </div>
</x-app-layout>
