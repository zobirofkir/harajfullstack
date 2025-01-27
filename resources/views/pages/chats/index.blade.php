<x-app-layout title="الرسائل">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold mb-4 text-gray-700">الرسائل</h1>

        <!-- قائمة الرسائل -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            @if ($chats->isEmpty())
                <p class="text-gray-600 text-center">لا توجد رسائل حتى الآن.</p>
            @else
                <div class="space-y-6">
                    @foreach ($chats as $chat)
                        <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg hover:shadow-md transition">
                            <!-- معلومات المستخدم -->
                            <div class="flex items-center space-x-4">
                                <img src="{{ $chat->messages->first()->user->image ?? 'https://icons.iconarchive.com/icons/icons8/windows-8/512/Users-Guest-icon.png' }}"
                                     alt="User Avatar"
                                     class="w-12 h-12 rounded-full">

                                <div>
                                    <p class="font-medium text-gray-700">{{ $chat->username ?? 'مستخدم مجهول' }}</p>
                                    <p class="text-xs text-gray-400">{{ $chat->created_at->diffForHumans() ?? '' }}</p>
                                </div>
                            </div>

                            <!-- زر عرض المحادثة -->
                            <a href="{{ route('chats.show', ['userName' => $chat->username, 'carId' => $chat->car_id]) }}"
                               class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                عرض المحادثة
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
