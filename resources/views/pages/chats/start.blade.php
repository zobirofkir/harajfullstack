<x-app-layout title="محادثة مع {{ optional($user)->name ?? '' }}">
    <meta name="user-id" content="{{ Auth::id() }}">
    <meta name="chat-id" content="{{ $chat->id }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container mx-auto p-6 max-w-7xl">
        <!-- Main Section -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- User List (Left) -->
            <div class="bg-white rounded-lg p-6 mb-6 col-span-1 lg:col-span-1 shadow-md">
                <!-- Toggle Button for Mobile -->
                <div class="lg:hidden mb-4">
                    <button id="toggleUserList" class="text-blue-600 hover:text-blue-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 6h18M3 14h18M3 18h18" />
                        </svg>
                    </button>
                </div>

                <!-- User List -->
                <div id="userList" class="space-y-4 lg:block hidden">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">المستخدمين الذين اختاروا هذه السيارة</h2>
                    <ul class="space-y-4">
                        @foreach ($users as $user)
                            @php
                                $messageCount = $user->messages->where('chat_id', $chat->id)->count();
                            @endphp
                            <li class="flex items-center justify-between p-4 border-b border-gray-200 hover:bg-gray-100 transition cursor-pointer">
                                <a href="{{ route('chats.start', ['userName' => $user->name, 'carId' => $car->id]) }}" class="text-blue-600 hover:text-blue-800 transition">
                                    <div class="flex gap-4 items-center">
                                        <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-white text-lg font-semibold">
                                            {{ strtoupper(optional($user)->name[0] ?? '') }}
                                        </div>
                                        <span class="text-gray-900 text-lg">{{ optional($user)->name ?? 'مستخدم مجهول' }}</span>
                                        <div class="w-8 h-8 bg-red-500 text-white text-sm rounded-full flex justify-center items-center">
                                            {{ $messageCount }}
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Chat Box (Right) -->
            <div class="bg-gray-50 shadow-md rounded-lg p-6 h-[85vh] overflow-y-auto mb-6 col-span-1 lg:col-span-3">
                <div class="flex flex-col h-full">
                    <div class="flex-grow overflow-y-auto pb-6" id="chat-box">
                        <ul id="message-list" class="space-y-4">
                            @foreach ($messages as $message)
                                <li class="flex gap-4 items-start {{ $message->user_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                                    @if($message->user_id !== Auth::id())
                                        <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-white text-lg font-semibold">
                                            {{ strtoupper(optional($message->user)->name[0] ?? '') }}
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
                    <form id="messageForm" class="flex items-center bg-white shadow-md rounded-lg p-4">
                        @csrf
                        <input id="messageInput" type="text" name="content" class="flex-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none text-gray-800 placeholder-gray-400 transition" placeholder="اكتب رسالتك..." required>
                        <button type="submit" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 focus:outline-none transition ml-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggleUserList').addEventListener('click', function() {
            document.getElementById('userList').classList.toggle('hidden');
        });

        document.getElementById('messageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const messageInput = document.getElementById('messageInput');
            const content = messageInput.value;
            if (content) {
                axios.post("{{ route('chats.send', $chat) }}", {
                    content: content,
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }).then(response => {
                    const chatBox = document.getElementById("chat-box");
                    const newMessage = `
                        <li class="flex gap-4 items-start justify-end">
                            <div class="max-w-lg p-4 rounded-lg shadow-md text-sm bg-blue-600 text-white relative">
                                <p>${content}</p>
                            </div>
                        </li>
                    `;
                    const messageList = document.getElementById("message-list");
                    messageList.insertAdjacentHTML('beforeend', newMessage);
                    chatBox.scrollTop = chatBox.scrollHeight;  // Scroll down after adding the message
                    messageInput.value = ''; // Clear input after sending
                }).catch(error => {
                    console.log("Error sending message", error);
                });
            }
        });
    </script>

</x-app-layout>
