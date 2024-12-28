@php
    $categories = App\Services\Facades\CategoryFacade::index()['categories'];
@endphp

<div>
    <div class="flex flex-row gap-4 overflow-x-auto px-4 sm:px-6 lg:px-8 mb-8">
        @foreach ($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}">
                <div class="flex flex-row items-center gap-4 w-48 sm:w-64 md:w-72 lg:w-80 bg-white shadow-lg rounded-lg p-4 text-center mb-10">
                    <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->title }}" class="w-12 h-12 object-cover rounded-md">
                    <h1 class="text-xl font-semibold text-gray-800 truncate">{{ $category->title }}</h1>
                </div>
            </a>
        @endforeach
    </div>
</div>
