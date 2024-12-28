<x-app-layout title="أنواع الوقود">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">أنواع الوقود</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($gasolines as $gasoline)
                <a href="{{ route('gasolines.show', $gasoline->id) }}">
                    <div class="border border-gray-300 rounded-lg shadow hover:shadow-lg p-4 bg-white">
                        <h2 class="text-lg font-semibold text-gray-700">{{ $gasoline->type }}</h2>
                        <p class="text-sm text-gray-500 mt-1">عدد السيارات: {{ $gasoline->cars()->count() }}</p>
                        <p class="text-sm text-gray-500 mt-1">تم الإضافة في: {{ $gasoline->created_at->format('M d, Y') }}</p>
                    </div>
                </a>
            @empty
                <p class="text-gray-600">لا توجد أنواع وقود متوفرة حاليًا.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
