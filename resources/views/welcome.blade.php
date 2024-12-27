<x-app-layout title="{{ config('app.name') }}">
    <div class="container mx-auto py-8 px-4 text-center">
        <h1 class="text-4xl font-bold text-primary-600 mb-6 uppercase tracking-wide">{{ config('app.name') }}</h1>
    </div>

    @include('components.search')

    <div class="flex flex-col lg:flex-row">
        <div class="w-full lg:w-1/4 mb-8 lg:mb-0 lg:mr-4">
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-bold text-gray-800 mb-4">الفئات</h2>
                <ul class="space-y-4">
                    @foreach (range(1, 4) as $category)
                        <li class="flex items-center space-x-4 rtl:space-x-reverse">
                            <img src="https://via.placeholder.com/50" alt="الفئة {{ $category }}" class="w-12 h-12 object-cover rounded-md">
                            <a href="#" class="text-gray-600 hover:text-primary-600">الفئة {{ $category }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="flex flex-col justify-center items-center space-y-8 p-4 w-full">
            @foreach (range(1, 20) as $item)
                <div class="group flex flex-col lg:flex-row items-center gap-6 bg-white shadow-lg rounded-lg p-4 w-full max-w-md lg:max-w-4xl transform transition-all duration-300 ease-in-out hover:shadow-2xl hover:scale-105 hover:bg-primary-50">
                    <div class="w-full lg:w-1/4 max-w-xs">
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
