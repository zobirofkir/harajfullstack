<x-app-layout>
    @php
        $titleQuery = request('query');
        $startDate = request('start_date');
        $endDate = request('end_date');
        $price = request('price');

        $query = App\Models\Car::query()->orderBy('created_at', 'desc');

        if ($titleQuery) {
            $query->where('title', 'LIKE', '%'.$titleQuery.'%');
        }

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if ($price) {
            $query->where('price', '<=', $price);
        }

        $cars = $query->paginate(1000);
    @endphp


    <div class="container mx-auto py-8 md:px-0 px-10">

        @include('components.search')

        <h2 class="text-2xl font-semibold text-gray-400 mb-6">نتائج البحث</h2>

        @if ($cars->isEmpty())
            <p class="text-gray-400">لا توجد سيارات بهذا العنوان.</p>
        @else
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:w-1/4 w-full md:block hidden">
                <div class="bg-white shadow-xl rounded-lg p-6 space-y-6">
                    <h2 class="text-xl font-bold text-gray-400 mb-4">
                        <i class="fas fa-filter mr-2"></i> فلترة البحث
                    </h2>

                    <!-- Reset Filters -->
                    <div class="mb-6">
                        <a href="{{ url()->current() }}" class="block text-center bg-red-500 text-white py-2 rounded-md hover:bg-red-600 transition duration-300">
                            <i class="fas fa-times-circle mr-2"></i> إعادة التصفية
                        </a>
                    </div>

                    <!-- Date Filter -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-400 mb-2 cursor-pointer" onclick="toggleDropdown('dateDropdown')">
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
                                    <button type="submit" class="w-full text_custom_bg_blue text-white py-2 rounded-md hover:bg-primary-700 transition duration-300">
                                        <i class="fas fa-search mr-2"></i> تصفية
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Price Filter -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-400 mb-2 cursor-pointer" onclick="toggleDropdown('priceDropdown')">
                            <i class="fas fa-dollar-sign mr-2"></i> تصفية حسب السعر
                        </h3>
                        <div id="priceDropdown" class="filter-dropdown space-y-4 max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                            <form action="#" method="GET">
                                <div class="space-y-4">
                                    <label for="price" class="block text-gray-600">
                                        <i class="fas fa-arrow-alt-circle-down mr-2"></i> السعر:
                                    </label>
                                    <input type="number" id="price" name="price" value="{{ $price }}" placeholder="أدخل السعر الأقصى" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($cars as $car)
                    <a href="{{ route('cars.show', $car->slug) }}">
                        <div class="group bg-white shadow-lg rounded-lg overflow-hidden transition duration-300 hover:shadow-2xl transform hover:scale-105">
                            <!-- Image -->
                            <div class="w-full h-56 lg:h-64 overflow-hidden relative">
                                <img src="{{ asset('storage/'.$car->images[0]) }}" alt="{{ $car->title }}" class="w-full h-full object-cover">
                                <div class="absolute top-0 right-0 bg-gray-400 text-white px-3 py-1 text-sm font-semibold rounded-bl-lg">
                                    {{ $car->category_title }}
                                </div>
                            </div>
                            <!-- Content -->
                            <div class="p-4">
                                <h1 class="text-base lg:text-lg font-semibold text-gray-400 group-hover:text-gray-400 transition-colors duration-300 mb-2">
                                    {{ Str::limit($car->title, 30) }}
                                </h1>
                                <h2 class="text-gray-400 text-xl font-bold group-hover:text-primary-700 transition-colors duration-300">
                                    <i class="fas fa-money-bill-wave"></i> {{ $car->price }} ريال
                                </h2>
                            </div>
                            <!-- Hover Effect -->
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-30 transition-all duration-300"></div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
        @endif
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

</x-app-layout>
