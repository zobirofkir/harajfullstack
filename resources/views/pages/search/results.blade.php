<x-app-layout>
    <div class="container mx-auto py-8 md:px-0 px-10">

        @include('components.search')

        <h2 class="text-2xl font-semibold text-gray-400 mb-6">نتائج البحث</h2>

        @if ($cars->isEmpty())
            <p class="text-gray-400">لا توجد سيارات بهذا العنوان.</p>
        @else
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
        @endif
    </div>
</x-app-layout>
