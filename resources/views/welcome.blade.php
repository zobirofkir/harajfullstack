<x-app-layout>
    <div class="container mx-auto py-8 px-4 text-center">
        <h1 class="text-4xl font-bold text-primary-600 mb-6 uppercase tracking-wide">{{ config('app.name') }}</h1>
    </div>

    @include('components.search')
</x-app-layout>
