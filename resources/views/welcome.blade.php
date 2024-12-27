<x-app-layout title="{{ config('app.name') }}">

    <!-- Hero Section -->
    @include('components.hero')
    
    <!-- Search Component -->
    @include('components.search')

    <!-- Categories Section -->
    <div class="container mx-auto py-12 px-4">
        <h2 class="text-2xl font-semibold text-center text-primary-600 mb-8">استعرض الفئات المختلفة</h2>
        <div class="flex flex-wrap justify-center gap-6">
            @foreach (range(1, 4) as $category)
                <div class="bg-white shadow-md rounded-lg w-1/3 lg:w-1/4 p-6 text-center">
                    <img src="https://via.placeholder.com/100" alt="الفئة {{ $category }}" class="w-24 h-24 object-cover rounded-full mb-4 mx-auto">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">الفئة {{ $category }}</h3>
                    <a href="#" class="text-primary-600 hover:text-primary-700">استكشاف</a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Car Listings Section -->
    <div class="container mx-auto py-12 px-4" id="car-listing">
        <h2 class="text-2xl font-semibold text-center text-primary-600 mb-8">استعرض السيارات المتاحة</h2>
        <div class="flex flex-wrap justify-center gap-6">
            @foreach (range(1, 20) as $item)
                <div class="group flex flex-col lg:flex-row items-center gap-6 bg-white shadow-lg rounded-lg p-6 w-full max-w-md lg:max-w-4xl transform transition-all duration-300 ease-in-out hover:shadow-2xl hover:scale-105 hover:bg-primary-50">
                    <div class="w-full lg:w-1/3 max-w-xs">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiRMSZQd-eWCLMZCcCecDLlpsfnr1_T9lxEg&s" alt="voiture"
                             class="w-full h-full object-cover rounded-lg transform transition-all duration-300 ease-in-out group-hover:rotate-3 group-hover:scale-110">
                    </div>
                    <div class="flex-1 text-center lg:text-right">
                        <h1 class="text-base lg:text-lg font-semibold text-gray-800 group-hover:text-primary-600 transition-colors duration-300">
                            لوريم إيبسوم، دولور سيت أميت كونسيكتيتور أديبيسيسينغ إيليت. دوكيموس، ديبييتيس؟
                        </h1>
                        <h2 class="text-primary-600 text-base lg:text-lg mt-2 font-bold group-hover:text-primary-700 transition-colors duration-300">
                             5000 دولار
                        </h2>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
