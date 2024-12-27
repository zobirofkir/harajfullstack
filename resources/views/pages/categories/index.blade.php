<x-app-layout title="{{$categories->first()->title}}">
    <div class="container mx-auto px-4 py-8 h-screen">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Categories</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="block border border-gray-300 rounded-lg shadow hover:shadow-lg p-4 bg-white">
                    <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->title }}" class="w-full h-48 object-cover rounded-md mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">{{ Str::limit($category->title, 30) }}</h2>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
