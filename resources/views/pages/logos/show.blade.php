<x-app-layout title="{{ $logo->title }}">
    <div class="container mx-auto py-8 h-screen">
        <!-- Logo Information -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-semibold text-gray-800">{{ $logo->title }}</h2>
            <p class="text-gray-600">{{ $logo->description }}</p>
        </div>

        <!-- Cars related to the logo -->
        @if ($cars->isEmpty())
            <p class="text-gray-600">لا توجد سيارات مرتبطة بهذا الشعار.</p>
        @else
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">السيارات المرتبطة بهذا الشعار:</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($cars as $car)
                    <a href="{{ route('cars.show', $car->slug) }}">
                        <div class="group bg-white shadow-lg rounded-lg overflow-hidden transition duration-300 hover:shadow-2xl transform hover:scale-105">
                            <!-- Image -->
                            <div class="w-full h-56 lg:h-64 overflow-hidden relative">
                                <img src="{{ asset('storage/'.$car->images[0]) }}" alt="{{ $car->title }}" class="w-full h-full object-cover">
                            </div>
                            <!-- Content -->
                            <div class="p-4">
                                <h1 class="text-base lg:text-lg font-semibold text-gray-800 group-hover:text-primary-600 transition-colors duration-300 mb-2">
                                    {{ Str::limit($car->title, 30) }}
                                </h1>
                                <h2 class="text-primary-600 text-xl font-bold group-hover:text-primary-700 transition-colors duration-300">
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
