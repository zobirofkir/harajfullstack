<x-app-layout title="{{ config('app.name') }}">

    @include('components.hero')

    @include('components.search')

    <div class="container mx-auto py-12 px-4 md:px-10 px-4">
        
        <div class="flex flex-col lg:flex-row gap-8">

            <div class="lg:w-1/4 w-full">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">فلترة البحث</h2>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">الفئات</h3>
                        <ul class="space-y-4">
                            @foreach (range(1, 4) as $category)
                                <li class="flex items-center space-x-4 rtl:space-x-reverse">
                                    <img src="https://via.placeholder.com/50" alt="الفئة {{ $category }}" class="w-12 h-12 object-cover rounded-md">
                                    <a href="#" class="text-gray-600 hover:text-primary-600">الفئة {{ $category }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">تصفية حسب التاريخ</h3>
                        <form action="#" method="GET">
                            <div class="space-y-4">
                                <label for="start_date" class="block text-gray-600">من:</label>
                                <input type="date" id="start_date" name="start_date" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                            </div>
                            <div class="space-y-4 mt-4">
                                <label for="end_date" class="block text-gray-600">إلى:</label>
                                <input type="date" id="end_date" name="end_date" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="w-full bg-primary-600 text-white py-2 rounded-md hover:bg-primary-700 transition duration-300">تصفية</button>
                            </div>
                        </form>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">تصفية حسب السعر</h3>
                        <form action="#" method="GET">
                            <div class="space-y-4">
                                <label for="min_price" class="block text-gray-600">السعر الأدنى:</label>
                                <input type="number" id="min_price" name="min_price" placeholder="من" class="w-full border-gray-300 rounded-md shadow-sm p-2">

                                <label for="max_price" class="block text-gray-600 mt-4">السعر الأعلى:</label>
                                <input type="number" id="max_price" name="max_price" placeholder="إلى" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="w-full bg-primary-600 text-white py-2 rounded-md hover:bg-primary-700 transition duration-300">تصفية</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="lg:w-3/4 w-full">
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
        </div>
    </div>
</x-app-layout>
