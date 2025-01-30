<x-app-layout title="محادثة مع {{ $user->name }}">
    <div class="container mx-auto p-6">
        <!-- Header Section -->
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">محادثة مع {{ $user->name }}</h1>

        <!-- Chat Box -->
        <div class="bg-white shadow-lg rounded-lg p-6 h-96 overflow-y-auto mb-6">
            <ul class="space-y-4">
                @foreach ($messages as $message)
                    <li class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-white text-xl">
                            {{ strtoupper($message->user->name[0]) }}
                        </div>

                        <div class="flex-1">
                            <div class="font-semibold text-gray-800">{{ $message->user->name }}</div>
                            <p class="text-gray-700 mt-1">{{ $message->content }}</p>
                            <div class="text-xs text-gray-500 mt-2">{{ $message->created_at->diffForHumans() }}</div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Message Input -->
        <form method="POST" action="{{ route('chats.send', $user->id) }}" class="flex items-center space-x-4">
            @csrf
            <input type="text" name="content" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400" placeholder="أرسل رسالة" required>

            <button type="submit" class="bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">إرسال</button>
        </form>
    </div>
</x-app-layout>
