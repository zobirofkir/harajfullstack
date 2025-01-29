<x-app-layout title="الرسائل">
    <div class="container mx-auto px-4 py-6 flex flex-col md:flex-row border rounded-lg shadow-lg overflow-hidden">
        <!-- Sidebar: Users List (Dropdown on Mobile) -->
        <div class="w-full md:w-1/3 bg-gray-50 border-b md:border-r p-4 overflow-y-auto md:h-full">
            <div class="block md:hidden">
                <!-- Button to toggle the dropdown -->
                <button id="dropdownToggle" class="w-full text-left px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                    اختر مستخدمًا
                </button>
                <ul id="userDropdown" class="space-y-4 mt-2 hidden md:block">
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

            <input id="filterInput" type="text" placeholder="ابحث عن محادثات"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 mb-4 hidden md:block" />

            <ul id="userList" class="space-y-4 md:block hidden">
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
        <div class="w-full md:w-2/3 flex flex-col">
            <div id="chatHeader" class="p-4 bg-gray-100 border-b text-gray-800 font-semibold text-lg">حدد مستخدمًا لعرض الدردشة</div>
            <div id="chatMessages" class="flex-1 bg-gray-50 p-4 overflow-y-auto h-[50vh] md:h-[70vh]"></div>

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
        // Toggle the visibility of the user dropdown on mobile
        document.getElementById('dropdownToggle').addEventListener('click', function() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        });

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

        // جلب المحادثات الخاصة بالمستخدم المصادق عليه فقط مع المستخدم المختار
        const chats = @json($chats);
        const selectedChat = chats.find(c =>
            c.messages.some(msg =>
                (msg.user_id == userId && msg.receiver_id == {{ Auth::id() }}) ||
                (msg.receiver_id == userId && msg.user_id == {{ Auth::id() }})
            )
        );

        if (selectedChat) {
            document.getElementById('chatHeader').textContent = selectedChat.messages[0].user.name;
            const messagesContainer = document.getElementById('chatMessages');
            messagesContainer.innerHTML = selectedChat.messages.map(msg => {
                const createdAt = new Date(msg.created_at);
                const formattedDate = createdAt.toLocaleString('ar-EG', {
                    weekday: 'short', year: 'numeric', month: 'short',
                    day: 'numeric', hour: '2-digit', minute: '2-digit'
                });

                return `
                    <div class="flex ${msg.user_id == {{ Auth::id() }} ? 'justify-end' : 'justify-start'} mb-6">
                        <div class="bg-gradient-to-r ${msg.user_id == {{ Auth::id() }} ? 'from-green-400 to-green-500' : 'from-gray-100 to-gray-200'} p-4 rounded-xl shadow-xl w-3/4 max-w-md">
                            <div class="flex justify-between items-center mb-3">
                                <img src="{{ asset('storage/') }}/${msg.user.image}" alt="user" class="w-10 h-10 rounded-full border-2 border-white shadow-md">
                                <div class="flex flex-col ml-2">
                                    <span class="text-gray-800 text-sm font-semibold">${msg.user.name}</span>
                                    <span class="text-gray-500 text-xs italic">${formattedDate}</span>
                                </div>
                            </div>
                            <div class="p-4 bg-white rounded-lg shadow-inner">
                                <p class="text-gray-800 text-lg">${msg.content}</p>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');

            document.getElementById('messageForm').action = "/chats/" + selectedChat.id + "/messages";
            document.getElementById('messageForm').classList.remove('hidden');
        } else {
            document.getElementById('chatMessages').innerHTML = '<p class="text-gray-700 text-center">لا توجد رسائل بعد.</p>';
        }
    });
});

    </script>
</x-app-layout>
