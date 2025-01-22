<x-app-layout title="{{ config('app.name') }}">
    @include('components.search')

    <section>
        @include('components.plan')
    </section>

    <div>
        @include('components.cars')
    </div>

</x-app-layout>
