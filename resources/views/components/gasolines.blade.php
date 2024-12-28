@php
    $gasolines = App\Services\Facades\GasolineFacade::index()['gasolines'];
@endphp

<div>
    <div class="flex flex-row gap-4 overflow-x-auto px-4 sm:px-6 lg:px-8 mb-8">
        @foreach ($gasolines as $gasoline)
            <a href="{{ route('gasolines.show', $gasoline->id) }}">
                <div class="flex flex-row items-center justify-center gap-4 w-48 sm:w-64 md:w-72 lg:w-80 bg-white shadow-lg rounded-lg p-4 text-center mb-4">
                    <h1 class="text-xl font-semibold text-gray-400 truncate">{{ $gasoline->type }}</h1>
                </div>
            </a>
        @endforeach
    </div>
</div>
