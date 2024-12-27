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
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-filter mr-2"></i> فلترة البحث
                </h2>

                <!-- Reset Filters -->
                <div class="mb-6">
                    <a href="{{ url()->current() }}" class="block text-center bg-red-500 text-white py-2 rounded-md hover:bg-red-600 transition duration-300">
                        <i class="fas fa-times-circle mr-2"></i> إعادة التصفية
                    </a>
                </div>


                <!-- Car Figures Filter -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2 cursor-pointer" onclick="toggleDropdown('figuresDropdown')">
                        <i class="fas fa-car-side mr-2"></i> تصفية حسب النوع
                    </h3>
                    <div id="figuresDropdown" class="filter-dropdown space-y-4 max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <ul class="pl-6">
                            @foreach (['sedan', 'compact-sedan', 'luxury-sedan', 'luxury-suv', 'coupe', 'hatchback', 'van', 'small-pickup', 'large-pickup', 'vintage'] as $figure)
                                <li class="flex items-center space-x-4 rtl:space-x-reverse hover:bg-gray-100 rounded-md py-2">
                                    <!-- Use different icons based on car type -->
                                    @switch($figure)
                                        @case('sedan')
                                            <i class="fas fa-car-side w-8 h-8 text-gray-600"></i>
                                            @break
                                        @case('compact-sedan')
                                            <i class="fas fa-car w-8 h-8 text-gray-600"></i>
                                            @break
                                        @case('luxury-sedan')
                                            <i class="fas fa-car-alt w-8 h-8 text-gray-600"></i>
                                            @break
                                        @case('luxury-suv')
                                            <i class="fas fa-car-side w-8 h-8 text-gray-600"></i>
                                            @break
                                        @case('coupe')
                                            <i class="fas fa-car w-8 h-8 text-gray-600"></i>
                                            @break
                                        @case('hatchback')
                                            <i class="fas fa-car w-8 h-8 text-gray-600"></i>
                                            @break
                                        @case('van')
                                            <i class="fas fa-shuttle-van w-8 h-8 text-gray-600"></i>
                                            @break
                                        @case('small-pickup')
                                            <i class="fas fa-truck-pickup w-8 h-8 text-gray-600"></i>
                                            @break
                                        @case('large-pickup')
                                            <i class="fas fa-truck w-8 h-8 text-gray-600"></i>
                                            @break
                                        @case('vintage')
                                            <i class="fas fa-car-rear w-8 h-8 text-gray-600"></i>
                                            @break
                                    @endswitch
                                    <a href="{{ url()->current() . '?figure=' . $figure }}" class="text-gray-600 hover:text-primary-600 transition-colors duration-300">
                                        {{ __($figure) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Categories Filter -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2 cursor-pointer" onclick="toggleDropdown('categoriesDropdown')">
                        <i class="fas fa-th-list mr-2"></i> الفئات
                    </h3>
                    <div id="categoriesDropdown" class="filter-dropdown space-y-4 max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <ul class="pl-6">
                            @foreach ($categories['categories'] as $category)
                                <li class="flex items-center space-x-4 rtl:space-x-reverse hover:bg-gray-100 rounded-md py-2">
                                    <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->title }}" class="w-12 h-12 object-cover rounded-md">
                                    <a href="{{ url()->current() . '?category=' . $category->id }}" class="text-gray-600 hover:text-primary-600 transition-colors duration-300">
                                        {{ $category->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Date Filter -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2 cursor-pointer" onclick="toggleDropdown('dateDropdown')">
                        <i class="fas fa-calendar-day mr-2"></i> تصفية حسب التاريخ
                    </h3>
                    <div id="dateDropdown" class="filter-dropdown space-y-4 max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <form action="#" method="GET">
                            <div class="space-y-4">
                                <label for="start_date" class="block text-gray-600">
                                    <i class="fas fa-calendar-alt mr-2"></i> من:
                                </label>
                                <input type="date" id="start_date" name="start_date" value="{{ $startDate }}" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                            </div>
                            <div class="space-y-4 mt-4">
                                <label for="end_date" class="block text-gray-600">
                                    <i class="fas fa-calendar-alt mr-2"></i> إلى:
                                </label>
                                <input type="date" id="end_date" name="end_date" value="{{ $endDate }}" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="w-full bg-primary-600 text-white py-2 rounded-md hover:bg-primary-700 transition duration-300">
                                    <i class="fas fa-search mr-2"></i> تصفية
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2 cursor-pointer" onclick="toggleDropdown('priceDropdown')">
                        <i class="fas fa-dollar-sign mr-2"></i> تصفية حسب السعر
                    </h3>
                    <div id="priceDropdown" class="filter-dropdown space-y-4 max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <form action="#" method="GET">
                            <div class="space-y-4">
                                <label for="min_price" class="block text-gray-600">
                                    <i class="fas fa-arrow-alt-circle-down mr-2"></i> السعر الأدنى:
                                </label>
                                <input type="number" id="min_price" name="min_price" value="{{ $minPrice }}" placeholder="من" class="w-full border-gray-300 rounded-md shadow-sm p-2">

                                <label for="max_price" class="block text-gray-600 mt-4">
                                    <i class="fas fa-arrow-alt-circle-up mr-2"></i> السعر الأعلى:
                                </label>
                                <input type="number" id="max_price" name="max_price" placeholder="إلى" value="{{ $maxPrice }}" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cars Listing -->
        <div class="lg:w-3/4 w-full">
            <h2 class="text-2xl font-semibold text-center text-primary-600 mb-8">
                <i class="fas fa-car mr-2"></i> استعرض السيارات المتاحة
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($cars as $car)
                    <a href="{{ route('cars.show', $car->slug) }}">
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
                                    {{ Str::limit($car->title, 30) }}
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

<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);

        if (dropdown.classList.contains('max-h-0')) {
            dropdown.classList.remove('max-h-0');
            dropdown.classList.add('max-h-screen');
        } else {
            dropdown.classList.remove('max-h-screen');
            dropdown.classList.add('max-h-0');
        }
    }
</script>
