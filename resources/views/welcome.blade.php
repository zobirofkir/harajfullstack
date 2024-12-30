<x-app-layout title="{{ config('app.name') }}">
    @include('components.search')

    <div>
        @include('components.cars')
    </div>

</x-app-layout>
