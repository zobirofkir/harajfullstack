@if (!Auth::check())
    <p></p>
@else

    <div class="flex items-center justify-center gap-4 text-green-600 p-4 rounded-lg shadow-lg bg-white max-w-xs sm:max-w-md md:max-w-lg w-full">
        <i class="fas fa-gift text-2xl animate-bounce mr-2 text-green-500"></i>
        <span class="font-semibold text-xl text-center text-gray-800">
            {{ Auth::user()->plan }}
        </span>
    </div>

@endif
