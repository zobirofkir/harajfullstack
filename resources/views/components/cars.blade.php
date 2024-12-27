@php
    $categories = App\Services\Facades\CategoryFacade::index();
    $cars = App\Services\Facades\CarFacade::index();
    $categoryFilter = request('category');
    if ($categoryFilter) {
        $cars['cars'] = $cars['cars']->filter(function($car) use ($categoryFilter) {
            return $car->category_id == $categoryFilter;
        });
    }

    $startDate = request('start_date');
    $endDate = request('end_date');
    $minPrice = request('min_price');
    $maxPrice = request('max_price');

    if ($startDate && $endDate) {
        $cars['cars'] = $cars['cars']->filter(function($car) use ($startDate, $endDate) {
            return $car->created_at >= $startDate && $car->created_at <= $endDate;
        });
    }

    if ($minPrice && $maxPrice) {
        $cars['cars'] = $cars['cars']->filter(function($car) use ($minPrice, $maxPrice) {
            return $car->price >= $minPrice && $car->price <= $maxPrice;
        });
    }
@endphp

<div class="container mx-auto py-12 px-4 md:px-10">

    <div class="flex flex-col lg:flex-row gap-8">

        <div class="lg:w-1/4 w-full">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">فلترة البحث</h2>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">الفئات</h3>
                    <ul class="space-y-4">
                        @foreach ($categories['categories'] as $category)
                            <li class="flex items-center space-x-4 rtl:space-x-reverse">
                                <a href="{{ url()->current() . '?category=' . $category->id }}" class="text-gray-600 hover:text-primary-600">{{ $category->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">تصفية حسب التاريخ</h3>
                    <form action="#" method="GET">
                        <div class="space-y-4">
                            <label for="start_date" class="block text-gray-600">من:</label>
                            <input type="date" id="start_date" name="start_date" value="{{ $startDate }}" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div class="space-y-4 mt-4">
                            <label for="end_date" class="block text-gray-600">إلى:</label>
                            <input type="date" id="end_date" name="end_date" value="{{ $endDate }}" class="w-full border-gray-300 rounded-md shadow-sm p-2">
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
                            <input type="number" id="min_price" name="min_price" value="{{ $minPrice }}" placeholder="من" class="w-full border-gray-300 rounded-md shadow-sm p-2">

                            <label for="max_price" class="block text-gray-600 mt-4">السعر الأعلى:</label>
                            <input type="number" id="max_price" name="max_price" value="{{ $maxPrice }}" placeholder="إلى" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="w-full bg-primary-600 text-white py-2 rounded-md hover:bg-primary-700 transition duration-300">تصفية</button>
                        </div>
                    </form>
                </div>

                <!-- Reset Filters Button -->
                <div class="mt-6">
                    <a href="{{ url()->current() }}" class="w-full bg-red-600 text-white py-2 px-4 rounded-md text-center hover:bg-red-700 transition duration-300">
                        إعادة تعيين الفلاتر
                    </a>
                </div>
            </div>
        </div>

        <div class="lg:w-3/4 w-full">
            <h2 class="text-2xl font-semibold text-center text-primary-600 mb-8">استعرض السيارات المتاحة</h2>
            <div>
                @foreach ($cars['cars'] as $car)
                    <a href="{{ url('/cars/'.$car->slug) }}">
                        <div class="flex flex-row space-x-4 group items-center justify-between bg-white rounded-lg shadow-lg hover:shadow-xl transform transition-all duration-300 ease-in-out hover:scale-105 p-4 mb-6">
                            <div class="max-w-[30%] max-w-[30%]">
                                <img src="{{asset('storage/'.$car->images[0])}}" alt="voiture"
                                     class="w-full h-[300px] object-cover rounded-lg transform transition-all duration-300 ease-in-out group-hover:rotate-3 group-hover:scale-110">
                            </div>

                            <h1 class="text-xl font-semibold text-gray-800 group-hover:text-primary-600 transition-colors duration-300 text-center">
                                {{$car->title}}
                            </h1>

                            <h2 class="text-primary-600 text-lg font-bold group-hover:text-primary-700 transition-colors duration-300">
                                {{$car->price}} دولار
                            </h2>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
</div>
