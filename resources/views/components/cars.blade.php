@php

    $figureFilter = request('figure');

    $startDate = request('start_date');
    $endDate = request('end_date');
    $price = request('price');


    $query = App\Models\Car::query()->orderBy('created_at', 'desc');


    if ($startDate && $endDate) {
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }


    if ($price) {
        $query->where('price', '<=', $price);
    }

    $cars = $query->paginate(16);
@endphp

<style>
    #dynamic-header {
        transition: opacity 0.4s ease, transform 0.4s ease;
    }
    .hidden-header {
        opacity: 0;
        transform: translateY(-50px);
        pointer-events: none;
    }
</style>

<div class="py-12 px-6">
    <div class="flex flex-col lg:flex-row gap-8 justify-center">
        <!-- Cars Listing -->
        <div class="lg:w-3/4 w-full md:-mt-0 -mt-[70px]">
            @if (!Auth::check())
            <h2 id="dynamic-header" class="text-2xl font-semibold text-center text-gray-500 mb-8 -mt-20">
                <i class="fas fa-car mr-2"></i> السيارات المتاحة
            </h2>
        @else
            <h2 id="dynamic-header" class="text-2xl font-semibold text-center text-gray-500 mb-8">
                <i class="fas fa-hand mr-2"></i> مرحبًا بعودتك {{ Auth::user()->name }}
            </h2>
        @endif

        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                @foreach ($cars as $car)
                    <a href="{{ route('cars.show', $car->slug) }}" class="group block relative">
                        <div class="bg-white rounded-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2">

                            <div class="mt-1">
                                <h1 class="text-md font-semibold text-gray-400 whitespace-nowrap truncate group-hover:text-primary-700 transition-colors duration-300 text-start">
                                    {{ Str::limit($car->title, 30) }}
                                </h1>
                            </div>

                            <div class="relative h-48 lg:h-64">
                                <img src="{{ asset('storage/'.$car->images[0]) }}" alt="{{ $car->title }}" class="w-full h-full object-cover rounded-md">
                            </div>

                            <div class="mt-1">
                                <div class="flex items-center justify-end">
                                    <span class="text-sm text-center font-bold text-gray-400 group-hover:text-primary-700 whitespace-nowrap">
                                        <i class="fas fa-money-bill-wave"></i> {{ number_format($car->price) }} ريال
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8 text-center rtl">
                <nav class="inline-flex items-center space-x-2 rtl:space-x-reverse">
                    @if ($cars->onFirstPage())
                        <span class="px-3 py-1 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed">
                            <i class="fas fa-angle-right"></i> السابق
                        </span>
                    @else
                        <a href="{{ $cars->previousPageUrl() }}" class="px-3 py-1 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md">
                            <i class="fas fa-angle-right"></i> السابق
                        </a>
                    @endif

                    @foreach ($cars->getUrlRange(1, $cars->lastPage()) as $page => $url)
                        @if ($page == $cars->currentPage())
                            <span class="px-3 py-1 bg-primary-600 text-white rounded-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if ($cars->hasMorePages())
                        <a href="{{ $cars->nextPageUrl() }}" class="px-3 py-1 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md">
                            التالي <i class="fas fa-angle-left"></i>
                        </a>
                    @else
                        <span class="px-3 py-1 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed">
                            التالي <i class="fas fa-angle-left"></i>
                        </span>
                    @endif
                </nav>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const header = document.getElementById("dynamic-header");
        let lastScrollY = window.scrollY;

        window.addEventListener("scroll", function () {
            if (window.scrollY > lastScrollY) {

                header.classList.add("hidden-header");
            } else {

                header.classList.remove("hidden-header");
            }
            lastScrollY = window.scrollY;
        });
    });
</script>

