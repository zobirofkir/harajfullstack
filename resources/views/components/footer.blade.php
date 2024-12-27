<footer class="bg-gray-200 text-gray-700 py-6 shadow-inner">
    <div class="container mx-auto text-center">
        <p class="text-sm font-medium">
            &copy; <span>{{ date('Y') }}</span> دينالي. جميع الحقوق محفوظة.
        </p>
        <div class="flex justify-center gap-6 mt-4">
            <!-- Social Media Links -->
            <a href="https://facebook.com" class="text-gray-600 hover:text-gray-800">
                <i class="fa-brands fa-facebook-square"></i>
            </a>
            <a href="https://twitter.com" class="text-gray-600 hover:text-gray-800">
                <i class="fa-brands fa-twitter-square"></i>
            </a>
            <a href="https://instagram.com" class="text-gray-600 hover:text-gray-800">
                <i class="fa-brands fa-instagram-square"></i>
            </a>
        </div>
        <div class="flex justify-center gap-6 mt-4">
            <a href="{{ route('cars.index') }}" class="text-gray-600 hover:text-gray-800">السيارات المتوفرة</a>
            <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-800">التصنيفات</a>
            <a href="#about" class="text-gray-600 hover:text-gray-800">حول</a>
            <a href="#contact" class="text-gray-600 hover:text-gray-800">اتصل بنا</a>
            <a href="{{ url('/admin/login') }}" class="text-gray-600 hover:text-gray-800">تسجيل الدخول</a>
        </div>
    </div>
</footer>
