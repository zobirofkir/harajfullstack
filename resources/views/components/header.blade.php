<div class="bg-gray-100 py-3 px-6 sm:px-8 md:px-12">
    <div class="flex justify-between items-center w-full max-w-screen-xl mx-auto">
        <!-- Contact Info -->
        <div class="flex gap-4 text-sm text-gray-600">
            <span class="font-bold text-gray-700">اسم الموقع</span>
            <span>example@email.com</span>
        </div>

        <!-- Social Media Icons -->
        <div class="flex gap-4 text-lg">
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
    </div>
</div>

<header class="flex justify-between items-center bg-white shadow-md p-4">
    <div>
        <a href="{{url('/')}}">
            <img src="{{asset('assets/images/logo.png')}}" alt="Logo" class="w-10 h-10">
        </a>
    </div>

    <button id="menuButton" class="block focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
</header>

<div id="sidebar" class="fixed top-0 right-0 h-full w-64 bg-gray-50 shadow-lg sidebar-hidden sidebar-transition z-50">
    <div class="p-4 flex justify-center">
        <a href="{{url('/')}}">
            <img src="{{asset('assets/images/logo.png')}}" alt="Sidebar Logo" class="w-20 h-20 rounded-full">
        </a>
    </div>

    <button id="closeButton" class="absolute top-4 left-4 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <ul class="mt-6 text-gray-700 p-4">
        <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
            <i class="fa-solid fa-building"></i>
            <span class="font-bold">دينالي</span>
        </li>

        <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
            <i class="fa-solid fa-car"></i>
            <a href="{{route('cars.index')}}" class="hover:text-gray-500">السيارات المتوفرة</a>
        </li>

        <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
            <i class="fa-solid fa-list"></i>
            <a href="{{route('categories.index')}}" class="hover:text-gray-500">التصنيفات</a>
        </li>

        <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
            <i class="fa-solid fa-building"></i>
            <a href="#about" class="hover:text-gray-500">حول</a>
        </li>

        <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
            <i class="fa-solid fa-phone"></i>
            <a href="#contact" class="hover:text-gray-500">اتصل بنا</a>
        </li>

        <!-- Login Item -->
        <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
            <i class="fa-solid fa-user-circle"></i>
            <a href="{{url('/login')}}" class="hover:text-gray-500">تسجيل الدخول</a>
        </li>
    </ul>
</div>

<div id="overlay" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-40"></div>
