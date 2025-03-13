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
        <div class="lg:w-3/4 w-full mt-10">
            @if (!Auth::check())
                <h2 id="dynamic-header" class="text-2xl font-semibold text-center text-gray-500 mb-8">
                    <i class="fas fa-car mr-2"></i> السيارات المتاحة
                </h2>
            @else
                <h2 id="dynamic-header" class="text-2xl font-semibold text-center text-gray-500 mb-8">
                    <i class="fas fa-hand ml-2"></i> مرحبًا بعودتك {{ Auth::user()->name }}
                </h2>
            @endif

            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                @foreach ($cars as $car)
                    <a href="{{ route('cars.show', $car->slug) }}" class="group">
                        <div class="bg-white rounded-lg shadow-sm hover:shadow-md p-2 sm:p-3 transform transition-all duration-300 hover:-translate-y-1">
                            <div class="mb-2 sm:mb-3">
                                <h1 class="text-xs sm:text-sm font-semibold text-gray-600 group-hover:text-primary-600 transition-colors duration-300 truncate">
                                    {{ Str::limit($car->title, 30) }}
                                </h1>
                            </div>

                            <div class="relative aspect-[4/3] rounded-lg overflow-hidden mb-2 sm:mb-3">
                                <img src="{{ asset('storage/'.$car->images[0]) }}"
                                     alt="{{ $car->title }}"
                                     class="w-full h-full object-cover">
                            </div>

                            <div class="flex items-center justify-between">
                                @if ($car->cost_type == 'شامل جميع التكاليف')
                                    <span class="text-[10px] sm:text-xs font-bold text-green-500">
                                        {{$car->cost_type}}
                                    </span>
                                @elseif ($car->cost_type == 'شامل الشحن')
                                    <span class="text-[10px] sm:text-xs font-bold text-gray-700">
                                        {{$car->cost_type}}
                                    </span>
                                @endif

                                <div class="flex items-center gap-1">
                                    <span class="text-sm sm:text-lg font-semibold text-gray-800">
                                        {{ number_format($car->price) }}
                                    </span>
                                    <img src="{{asset('assets/images/logo/saudi_riyal.png')}}"
                                         alt="ريال"
                                         class="w-3 h-3 sm:w-4 sm:h-4">
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                <nav class="inline-flex items-center gap-2 rounded-lg bg-white p-1 shadow-sm">
                    @if ($cars->onFirstPage())
                        <span class="px-3 py-2 text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-right"></i>
                        </span>
                    @else
                        <a href="{{ $cars->previousPageUrl() }}"
                           class="px-3 py-2 text-gray-600 hover:text-primary-600 transition-colors">
                            <i class="fas fa-angle-right"></i>
                        </a>
                    @endif

                    @foreach ($cars->getUrlRange(1, $cars->lastPage()) as $page => $url)
                        @if ($page == $cars->currentPage())
                            <span class="px-3 py-2 bg-primary-600 text-white rounded-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="px-3 py-2 text-gray-600 hover:text-primary-600 hover:bg-gray-50 rounded-md transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if ($cars->hasMorePages())
                        <a href="{{ $cars->nextPageUrl() }}"
                           class="px-3 py-2 text-gray-600 hover:text-primary-600 transition-colors">
                            <i class="fas fa-angle-left"></i>
                        </a>
                    @else
                        <span class="px-3 py-2 text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-left"></i>
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

