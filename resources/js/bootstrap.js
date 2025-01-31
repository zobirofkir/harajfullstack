import axios from 'axios';
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: 'bbda787fb8dec769a467',
    cluster: 'eu',
    forceTLS: true,
});

const userId = document.head.querySelector('meta[name="user-id"]')?.content;
const chatId = document.head.querySelector('meta[name="chat-id"]')?.content;

if (chatId) {
    window.Echo.private(`chat.${chatId}`)
        .listen("MessageSent", (event) => {
            console.log("New message received:", event.message);
            const chatBox = document.getElementById("chat-box");

            if (chatBox) {
                const newMessage = `
                    <li class="flex gap-4 items-start ${event.message.user_id === parseInt(userId) ? 'justify-end' : 'justify-start'}">
                        ${event.message.user_id !== parseInt(userId) ? `
                        <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-white text-lg font-semibold">
                            ${event.message.username[0].toUpperCase()}
                        </div>` : ''}
                        <div class="max-w-lg p-4 rounded-lg shadow-md text-sm ${event.message.user_id === parseInt(userId) ? 'bg-blue-600 text-white' : 'bg-white text-gray-900'} relative">
                            <p>${event.message.content}</p>
                        </div>
                    </li>
                `;
                chatBox.insertAdjacentHTML('beforeend', newMessage);
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
}
