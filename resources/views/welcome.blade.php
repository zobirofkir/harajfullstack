<x-app-layout title="{{ config('app.name') }}">
    @include('components.search')

    <div class="mt-8">
        @include('components.cars')
    </div>

</x-app-layout>
