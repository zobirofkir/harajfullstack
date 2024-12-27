<x-app-layout title="{{ config('app.name') }}">

    @include('components.logo')

    @include('components.search')

    @include('components.top-categories')

    <div class="mt-8">
        @include('components.cars')
    </div>
</x-app-layout>
