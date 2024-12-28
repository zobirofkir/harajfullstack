<x-app-layout title="{{ config('app.name') }}">
   <div>
        @include('components.search')

        @include('components.cars')
   </div>
</x-app-layout>
