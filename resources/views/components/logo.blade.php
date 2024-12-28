@php
    $logos = App\Services\Facades\LogoFacade::index();
@endphp

<div class="overflow-x-auto overflow-y-hidden mt-6 px-4 sm:px-6 lg:px-8">
    <div class="flex gap-6 flex-nowrap animate-marquee space-x-8">
        @foreach ($logos['logos'] as $logo)
            <a href="{{ route('logos.show', $logo->id) }}" class="flex-shrink-0 transform transition-all duration-500 ease-in-out hover:scale-105 hover:rotate-360">
                <img src="{{ asset('storage/' . $logo->image) }}" alt="Logo" class="w-24 h-24 object-contain transition-transform duration-300 ease-in-out hover:scale-110 mb-4 rounded-lg shadow-md">
                <h3 class="text-sm font-semibold text-gray-800 mt-2 hover:text-primary-600 transition-colors duration-300">
                    {{ Str::limit($logo->title, 15) }}
                </h3>
            </a>
        @endforeach
    </div>
</div>
