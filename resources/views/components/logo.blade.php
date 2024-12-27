@php
    $logos = App\Services\Facades\LogoFacade::index();
@endphp

<div class="overflow-x-auto mt-6 px-4 sm:px-6 lg:px-8">
    <h2 class="text-xl font-semibold text-right mb-4">العلامات التجارية</h2>
    <div class="flex gap-4 flex-nowrap">
        @foreach ($logos['logos'] as $logo)
            <a href="{{ route('logos.show', $logo->id) }}" class="flex-shrink-0">
                <img src="{{asset('storage/' . $logo->image)}}" alt="Logo" class="w-24 h-24 object-contain">
            </a>
        @endforeach
    </div>
</div>
