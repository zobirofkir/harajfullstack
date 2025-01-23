<x-app-layout title="{{ config('app.name') }}">
    @include('components.search')

        @if (Auth::check() && Auth::user()->account_type === 'مشتري')
            <section>
                @include('components.plan')
            </section>
        @else

        @endif

    <div>
        @include('components.cars')
    </div>

</x-app-layout>
