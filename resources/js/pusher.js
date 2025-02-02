import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

window.Echo.channel('user.' + document.querySelector('meta[name="user-id"]').content)
    .listen('MessageSent', (event) => {
        // console.log('تم استلام الرسالة:', event);

        if (event.message && event.message.content) {
            const messageList = document.getElementById("message-list");
            const chatBox = document.getElementById("chat-box");

            const newMessage = `
                <li class="flex gap-4 items-start ${event.message.user_id === document.querySelector('meta[name="user-id"]').content ? 'justify-end' : 'justify-start'}">
                    ${event.message.user_id !== document.querySelector('meta[name="user-id"]').content ? `
                        <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-white text-lg font-semibold">
                            ${event.message.username[0].toUpperCase()}
                        </div>
                    ` : ''}
                    <div class="max-w-lg p-4 rounded-lg shadow-md text-sm ${event.message.user_id === document.querySelector('meta[name="user-id"]').content ? 'bg-blue-600 text-white' : 'bg-white text-gray-900'} relative">
                        <p>${event.message.content}</p>
                    </div>
                </li>
            `;

            messageList.insertAdjacentHTML('beforeend', newMessage);
            chatBox.scrollTop = chatBox.scrollHeight;
        } else {
            console.error('بيانات الرسالة غير صالحة:', event);
        }
    });
