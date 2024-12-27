
<header class="flex justify-between items-center bg-white shadow-md p-4">
    <div>
    <img src="https://via.placeholder.com/40" alt="Logo" class="w-10 h-10">
    </div>

    <button id="menuButton" class="block focus:outline-none">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
    </button>
</header>

<div id="sidebar" class="fixed top-0 right-0 h-full w-64 bg-gray-50 shadow-lg sidebar-hidden sidebar-transition z-50">

    <div class="p-4 flex justify-center">
    <img src="https://via.placeholder.com/80" alt="Sidebar Logo" class="w-20 h-20 rounded-full">
    </div>

    <button id="closeButton" class="absolute top-4 left-4 focus:outline-none">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
    </button>

    <ul class="mt-6 text-gray-700 p-4">
    <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
        <i class="fa-solid fa-building"></i>
        <span class="font-bold">الشركة المغربية</span>
    </li>

    <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
        <i class="fa-solid fa-building"></i>
        <a href="#about" class="hover:text-gray-500">حول</a>
    </li>
    <li class="px-4 py-2 border-b border-gray-200 flex gap-2 items-center">
        <i class="fa-solid fa-phone"></i>
        <a href="#contact" class="hover:text-gray-500">اتصل بنا</a>
    </li>
    </ul>
</div>

<div id="overlay" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-40"></div>

