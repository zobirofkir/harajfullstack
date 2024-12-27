@php
    $categories = App\Services\Facades\CategoryFacade::index();
    $categoryFilter = request('category');
    $startDate = request('start_date');
    $endDate = request('end_date');
    $minPrice = request('min_price');
    $maxPrice = request('max_price');

    $query = App\Models\Car::query();

    if ($categoryFilter) {
        $query->where('category_id', $categoryFilter);
    }

    if ($startDate && $endDate) {
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    if ($minPrice && $maxPrice) {
        $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    $cars = $query->paginate(10);
@endphp

<div class="container mx-auto py-12 px-6 lg:px-16">
    <div class="flex flex-col lg:flex-row gap-8">

        <!-- Filters Sidebar -->
        <div class="lg:w-1/4 w-full">
            <div class="bg-white shadow-xl rounded-lg p-6 space-y-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4"><i class="fas fa-filter mr-2"></i> فلترة البحث</h2>

                <!-- Categories Filter -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2"><i class="fas fa-th-list mr-2"></i> الفئات</h3>
                    <ul class="space-y-4">
                        @foreach ($categories['categories'] as $category)
                            <li class="flex items-center space-x-4 rtl:space-x-reverse">
                                <img src="https://via.placeholder.com/50" alt="{{ $category->title }}" class="w-12 h-12 object-cover rounded-md">
                                <a href="{{ url()->current() . '?category=' . $category->id }}" class="text-gray-600 hover:text-primary-600 transition-colors duration-300">{{ $category->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Date Filter -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2"><i class="fas fa-calendar-day mr-2"></i> تصفية حسب التاريخ</h3>
                    <form action="#" method="GET">
                        <div class="space-y-4">
                            <label for="start_date" class="block text-gray-600"><i class="fas fa-calendar-alt mr-2"></i> من:</label>
                            <input type="date" id="start_date" name="start_date" value="{{ $startDate }}" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div class="space-y-4 mt-4">
                            <label for="end_date" class="block text-gray-600"><i class="fas fa-calendar-alt mr-2"></i> إلى:</label>
                            <input type="date" id="end_date" name="end_date" value="{{ $endDate }}" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="w-full bg-primary-600 text-white py-2 rounded-md hover:bg-primary-700 transition duration-300"><i class="fas fa-search mr-2"></i> تصفية</button>
                        </div>
                    </form>
                </div>

                <!-- Price Filter -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2"><i class="fas fa-dollar-sign mr-2"></i> تصفية حسب السعر</h3>
                    <form action="#" method="GET">
                        <div class="space-y-4">
                            <label for="min_price" class="block text-gray-600"><i class="fas fa-arrow-alt-circle-down mr-2"></i> السعر الأدنى:</label>
                            <input type="number" id="min_price" name="min_price" value="{{ $minPrice }}" placeholder="من" class="w-full border-gray-300 rounded-md shadow-sm p-2">

                            <label for="max_price" class="block text-gray-600 mt-4"><i class="fas fa-arrow-alt-circle-up mr-2"></i> السعر الأعلى:</label>
                            <input type="number" id="max_price" name="max_price" value="{{ $maxPrice }}" placeholder="إلى" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cars Listing -->
        <div class="lg:w-3/4 w-full">
            <h2 class="text-2xl font-semibold text-center text-primary-600 mb-8"><i class="fas fa-car mr-2"></i> استعرض السيارات المتاحة</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($cars as $car)
                    <a href="{{ url('/cars/'.$car->slug) }}">
                        <div class="group bg-white shadow-lg rounded-lg overflow-hidden transition duration-300 hover:shadow-2xl transform hover:scale-105">
                            <!-- Image -->
                            <div class="w-full h-56 lg:h-64 overflow-hidden relative">
                                <img src="{{ asset('storage/'.$car->images[0]) }}" alt="{{ $car->title }}" class="w-full h-full object-cover">
                                <div class="absolute top-0 right-0 bg-primary-600 text-white px-3 py-1 text-sm font-semibold rounded-bl-lg">
                                    {{ $car->category_title }}
                                </div>
                            </div>
                            <!-- Content -->
                            <div class="p-4">
                                <h1 class="text-base lg:text-lg font-semibold text-gray-800 group-hover:text-primary-600 transition-colors duration-300 mb-2">
                                    {{ $car->title }}
                                </h1>
                                <h2 class="text-primary-600 text-xl font-bold group-hover:text-primary-700 transition-colors duration-300">
                                    <i class="fas fa-dollar-sign"></i> {{ $car->price }}
                                </h2>
                            </div>
                            <!-- Hover Effect -->
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition-all duration-300"></div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 text-center">
                {{ $cars->links() }}
            </div>
        </div>

    </div>
</div>
