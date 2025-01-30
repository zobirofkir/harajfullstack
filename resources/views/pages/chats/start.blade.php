<x-app-layout title="محادثة مع {{ $user->name }}">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">محادثة مع {{ $user->name }}</h1>

        <div class="bg-white shadow-md rounded-lg p-4 mb-4 h-80 overflow-y-scroll">
            <ul>
                <ul>
                    @foreach ($messages as $message)
                        <li class="mb-4">
                            <div class="font-semibold">{{ $message->user->name }}</div>
                            <div>{{ $message->content }}</div>
                            <div class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</div>
                        </li>
                    @endforeach
                </ul>
            </ul>
        </div>

        <form method="POST" action="{{ route('chats.send', $chat->id) }}">
            @csrf
            <div class="flex space-x-2">
                <input type="text" name="message" class="w-full p-2 border rounded" placeholder="أرسل رسالة" required>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">إرسال</button>
            </div>
        </form>
    </div>
</x-app-layout>
