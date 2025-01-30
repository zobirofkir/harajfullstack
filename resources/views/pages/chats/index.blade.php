<x-app-layout title="الرسائل">
    <div class="flex bg-gray-50">
        <div class="w-full bg-white shadow-lg border-r p-6 overflow-y-auto flex flex-col">
            <h2 class="text-2xl font-bold text-gray-800 mb-5 text-center">المحادثات</h2>
            <div class="relative mb-4">
                <input id="filterInput" type="text" placeholder="🔍 ابحث عن المحادثات"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm text-gray-700 placeholder-gray-400" />
            </div>
            <ul id="chatList" class="space-y-3 overflow-y-auto flex-1">
                @foreach ($messages as $message)
                    <li class="chat-item p-4 bg-white rounded-lg shadow-md hover:bg-blue-100 cursor-pointer transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">
                                المرسل: {{ $message->user->name }} - المستلم: {{ $message->receiver->name }}
                            </span>
                        </div>

                        <div class="mt-4">
                            <h4 class="font-semibold text-gray-800">المحادثة</h4>
                            <div class="messages mt-2 space-y-2">
                                <div class="message flex justify-{{ $message->user_id == Auth::id() ? 'end' : 'start' }}">
                                    <div class="bg-{{ $message->user_id == Auth::id() ? 'blue' : 'gray' }}-100 p-3 rounded-lg max-w-xs">
                                        <p class="text-sm text-gray-800">{{ $message->content }}</p>
                                        <span class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
