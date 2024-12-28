<div class="bg-gray-100 py-1 px-6 sm:px-8 md:px-12">
    <!-- Contact Info -->
    <div class="flex justify-between items-center w-full max-w-screen-xl mx-auto overflow-x-auto overflow-y-hidden gap-10">
        <span class="font-bold text-gray-500 whitespace-nowrap mb-4 mt-4">
            <i class="fas fa-home mr-2 ml-4"></i>دينالي
        </span>

        <span class="font-bold text-gray-500 whitespace-nowrap mb-4 mt-4">
            <a href="{{url('/')}}">
                <i class="fas ml-4 fa-house-user mr-2"></i>الرئيسية
            </a>
        </span>

        <span class="font-bold text-gray-500 whitespace-nowrap mb-4 mt-4">
            <a href="{{url('/cars')}}">
                <i class="fas ml-4 fa-car mr-2"></i>دينالي السيارات
            </a>
        </span>

        <span class="font-bold text-gray-500 whitespace-nowrap mb-4 mt-4">
            <a href="{{url('/categories')}}">
                <i class="fas ml-4 fa-th mr-2"></i>التصنيفات
            </a>
        </span>


        <span class="font-bold text-gray-500 whitespace-nowrap mb-4 mt-4">
            <a href="{{url('/gasolines')}}">
                <i class="fas ml-4 fa-gas-pump mr-2"></i>الوقود
            </a>
        </span>


        <span class="font-bold text-gray-500 whitespace-nowrap mb-4 mt-4">
            <a href="{{url('/abouts')}}">
                <i class="fas ml-4 fa-building mr-2"></i>من نحن
            </a>
        </span>

        <span class="font-bold text-gray-500 whitespace-nowrap mb-4 mt-4">
            <a href="{{url('/contacts')}}">
                <i class="fas ml-4 fa-phone mr-2"></i>اتصل بنا
            </a>
        </span>

        <span class="font-bold text-gray-500 whitespace-nowrap mb-4 mt-4">
            <a href="{{url('/admin/login')}}">
                <i class="fas ml-4 fa-sign-in-alt mr-2"></i>تسجيل الدخول
            </a>
        </span>

    </div>
</div>

<header class="flex justify-between items-center bg-white shadow-md p-4 md:px-20 px-8">
    <div>
        <a href="{{url('/')}}" class="flex items-center gap-4">
            <img src="{{asset('assets/images/logo.png')}}" alt="Logo" class="w-10 h-10">
            <span class="font-bold text-gray-500 whitespace-nowrap md:block hidden text-xl">دينالي</span>
        </a>
    </div>

    <button id="menuButton" class="block focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <ul class="mt-6 text-gray-500 p-4">
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
            <i class="fa-solid fa-gas-pump"></i>
            <a href="{{route('gasolines.index')}}" class="hover:text-gray-500">الوقود</a>
        </li>

        <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
            <i class="fa-solid fa-building"></i>
            <a href="{{url('/abouts')}}" class="hover:text-gray-500">حول</a>
        </li>

        <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
            <i class="fa-solid fa-phone"></i>
            <a href="{{url('/contacts')}}" class="hover:text-gray-500">اتصل بنا</a>
        </li>

        <!-- Login Item -->
        <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
            <i class="fa-solid fa-user-circle"></i>
            <a href="{{url('/admin/login')}}" class="hover:text-gray-500">تسجيل الدخول</a>
        </li>
    </ul>
</div>

<div id="overlay" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-40"></div>
