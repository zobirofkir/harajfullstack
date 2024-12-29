<div class="bg-gray-100 py-1 px-6 sm:px-8 md:px-12">
    <!-- Contact Info -->
    <div class="flex justify-between items-center w-full max-w-screen-xl mx-auto overflow-x-auto overflow-y-hidden gap-10">

        <span class="font-bold text-gray-500 whitespace-nowrap mb-4 mt-4">
            <a href="{{url('/')}}">
                <i class="fas ml-4 fa-house-user mr-2"></i>الرئيسية
            </a>
        </span>

        <span class="font-bold text-gray-500 whitespace-nowrap mb-4 mt-4 cursor-pointer" onclick="openModal()">
            <p>
                <i class="fas ml-4 fa-search mr-2"></i>بحث
            </p>
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
                <i class="fas ml-4 fa-user mr-2"></i>الحساب
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


<!-- هيكل المودال -->
<div id="categoryModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50">
    <div class="bg-white w-full max-w-7xl h-auto max-h-[80vh] overflow-auto p-6 rounded-lg shadow-xl">
        <div class="flex justify-between mb-6 items-center">
            <h2 class="text-3xl font-semibold text-gray-800">الشعارات</h2>
            <button onclick="closeModal()" class="text-gray-600 text-3xl hover:text-gray-900 focus:outline-none">
                ×
            </button>
        </div>

        @php
            $logos = App\Services\Facades\LogoFacade::index();
        @endphp


        <!-- Scrollable category container -->
        <div class="overflow-x-auto overflow-y-hidden mt-6 px-4 sm:px-6 lg:px-8">
            <div class="flex gap-6 flex-nowrap animate-marquee space-x-8">
                @foreach ($logos['logos'] as $logo)
                    <a href="{{ route('logos.show', $logo->id) }}" class="flex-shrink-0 transform transition-all duration-500 ease-in-out hover:scale-105 hover:rotate-360 mb-4">
                        <img src="{{ asset('storage/' . $logo->image) }}" alt="Logo" class="w-24 h-24 object-contain transition-transform duration-300 ease-in-out hover:scale-110 mb-4 rounded-lg shadow-md">
                        <h3 class="text-sm font-semibold text-gray-400 mt-2 hover:text-primary-600 transition-colors duration-300">
                            {{ Str::limit($logo->title, 15) }}
                        </h3>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
</div>


<script>
    function openModal() {
        document.getElementById('categoryModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('categoryModal').classList.add('hidden');
    }
</script>


<div id="overlay" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-40"></div>
