<form action="{{ url('/search/cars') }}" method="GET" class="flex items-center justify-center space-x-4">
    <div class="relative w-full max-w-md">
        <input
            type="text"
            name="query"
            value="{{ request('query') }}"
            placeholder="ابحث عن سيارة..."
            class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        />
        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
    </div>
</form>
