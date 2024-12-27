<x-app-layout title="{{ $category->title }}">
    <div class="container mx-auto px-4 py-8 h-screen">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">السيارات في {{ $category->title }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($cars as $car)
                <a href="{{ route('cars.show', $car->slug) }}">
                    <div class="border border-gray-300 rounded-lg shadow hover:shadow-lg p-4 bg-white">
                        <img src="{{ asset('storage/'.$car->images[0]) ?? asset('default-image.jpg') }}" alt="{{ $car->title }}" class="w-full h-48 object-cover rounded-md mb-4">
                        <h2 class="text-lg font-semibold text-gray-700">{{ $car->title }}</h2>
                        <p class="mt-2 text-gray-900 font-bold">السعر: {{ $car->price }} $</p>
                        <p class="text-sm text-gray-500 mt-1">تم الإنشاء في: {{ $car->created_at->format('M d, Y') }}</p>
                    </div>
                </a>
            @empty
                <p class="text-gray-600">لا توجد سيارات في هذه الفئة.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
