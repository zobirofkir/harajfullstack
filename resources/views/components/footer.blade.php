<footer class="bg-gray-200 text-gray-700 py-6 shadow-inner">
    <div class="container mx-auto text-center">
        <p class="text-sm font-medium">
            &copy; <span>{{ date('Y') }}</span> دينالي. جميع الحقوق محفوظة.
        </p>
        <div class="flex justify-center gap-6 mt-4">
            <!-- Social Media Links -->
            <a href="https://tiktok.com" class="text-gray-600 hover:text-gray-800">
                <i class="fa-brands fa-tiktok"></i>
            </a>
            <a href="https://twitter.com" class="text-gray-600 hover:text-gray-800">
                <i class="fa-brands fa-twitter-square"></i>
            </a>
            <a href="https://instagram.com" class="text-gray-600 hover:text-gray-800">
                <i class="fa-brands fa-instagram-square"></i>
            </a>
        </div>
        <div class="flex md:flex-row flex-col justify-center gap-6 mt-4">
            <a href="{{url('/privacy')}}" class="text-gray-600 hover:text-gray-800 whitespace-nowrap">اتفاقية الاستخدام</a>
            <a href="{{ url('/contacts') }}" class="text-gray-600 hover:text-gray-800 whitespace-nowrap">اتصل بنا</a>
            @if (!Auth::check())
                <a href="{{ url('/login') }}" class="text-gray-600 hover:text-gray-800 whitespace-nowrap">تسجيل الدخول</a>
            @else
                
            @endif
        </div>
    </div>
</footer>
