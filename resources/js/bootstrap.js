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
            const messageContainer = document.getElementById("messages");
            if (messageContainer) {
                messageContainer.innerHTML += `<p><strong>${event.message.username}:</strong> ${event.message.content}</p>`;
            }
        });
}
