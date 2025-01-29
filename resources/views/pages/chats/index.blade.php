<x-app-layout title="الرسائل">
    <div class="container mx-auto px-4 py-6 h-screen flex border rounded-lg shadow-lg overflow-hidden">
        <!-- Sidebar: Users List -->
        <div class="w-1/3 bg-gray-50 border-r p-4 overflow-y-auto">
            <input id="filterInput" type="text" placeholder="ابحث عن محادثات"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 mb-4" />

                   <ul id="userList" class="space-y-4">
                    @foreach ($users as $user)
                        <li class="user-item p-2 rounded-lg hover:bg-gray-200 cursor-pointer" data-user-id="{{ $user->id }}">
                            <a class="text-gray-700 font-medium">
                                {{ $user->name }}
                                <span class="text-sm text-gray-500">({{ $user->message_count }} رسائل)</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

        </div>

        <!-- Chat Area -->
        <div class="w-2/3 flex flex-col">
            <div id="chatHeader" class="p-4 bg-gray-100 border-b text-gray-800 font-semibold text-lg">حدد مستخدمًا لعرض الدردشة</div>
            <div id="chatMessages" class="flex-1 bg-gray-50 p-4 overflow-y-auto h-[70vh]"></div>

            @auth
                <form id="messageForm" method="POST" class="flex space-x-4 p-4 border-t hidden">
                    @csrf
                    <textarea id="messageInput" name="content" rows="2" placeholder="اكتب رسالتك هنا..."
                              class="flex-grow px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500" required></textarea>
                    <button type="submit" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        إرسال
                    </button>
                </form>
            @else
                <p class="text-gray-700 p-4 text-center">يرجى تسجيل الدخول لإرسال رسالة.</p>
            @endauth
        </div>
    </div>

    <script>
        // Handle filtering of users list
        document.getElementById('filterInput').addEventListener('input', function() {
            const filterValue = this.value.toLowerCase();
            document.querySelectorAll('.user-item').forEach(item => {
                const userName = item.textContent.toLowerCase();
                item.style.display = userName.includes(filterValue) ? '' : 'none';
            });
        });

        // Handle user click to filter and display chat messages
        document.querySelectorAll('.user-item').forEach(item => {
            item.addEventListener('click', function() {
                const userId = this.dataset.userId;

                // Find the corresponding chat for the selected user
                const chats = @json($chats);
                const selectedChat = chats.find(c =>
                    (c.messages.some(msg => msg.user_id == userId) ||
                    c.messages.some(msg => msg.receiver_id == userId))
                );

                if (selectedChat) {
                    // Update chat header and display messages
                    document.getElementById('chatHeader').textContent = selectedChat.messages[0].user.name;
                    const messagesContainer = document.getElementById('chatMessages');
                    messagesContainer.innerHTML = selectedChat.messages.map(msg => `
                        <div class="flex ${msg.user_id == {{ Auth::id() }} ? 'justify-end' : 'justify-start'} mb-4">
                            <div class="bg-gray-100 p-3 rounded-lg shadow-md w-3/4">
                                <div class="text-gray-700 text-sm font-medium">${msg.user.name}</div>
                                <p class="text-gray-600 text-md">${msg.content}</p>
                                <span class="text-gray-500 text-xs">${msg.created_at}</span>
                            </div>
                        </div>
                    `).join('');

                    // Set the form action URL for sending messages to the selected chat
                    document.getElementById('messageForm').action = "/chats/" + selectedChat.id + "/messages";

                    document.getElementById('messageForm').classList.remove('hidden');
                } else {
                    document.getElementById('chatMessages').innerHTML = '<p class="text-gray-700 text-center">لا توجد رسائل بعد.</p>';
                }
            });
        });
    </script>
</x-app-layout>
