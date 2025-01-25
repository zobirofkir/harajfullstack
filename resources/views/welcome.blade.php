<x-app-layout title="{{ config('app.name') }}">

    <div>
        @include('components.cars')
    </div>

    {{-- @if (Auth::check() && Auth::user()->account_type === 'مشتري')
        <section class="flex justify-center">
            @include('components.plan')
        </section>
    @else

    @endif --}}

</x-app-layout>
