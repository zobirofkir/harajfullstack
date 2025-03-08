<x-app-layout title="{{ $user->name }} - السيارات">
    <div class="container mx-auto px-4 py-8 lg:py-12">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Profile Header Section -->
            <div class="relative">
                <!-- Banner Image with Gradient Overlay -->
                <div class="w-full h-[250px] relative">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-black/60"></div>
                    <img src="{{ asset('images/kings-banner.jpg') }}"
                         class="w-full h-full object-cover"
                         alt="Banner">
                </div>

                <!-- Profile Info Overlay -->
                <div class="absolute -bottom-20 w-full flex flex-col items-center">
                    <!-- Profile Image -->
                    <div class="w-36 h-36 rounded-full ring-4 ring-white shadow-lg overflow-hidden bg-white">
                        <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/logo.png') }}"
                             class="w-full h-full object-cover"
                             alt="{{ $user->name }}">
                    </div>
                </div>
            </div>

            <!-- User Info Section -->
            <div class="mt-24 text-center px-4">
                <div class="space-y-2">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-gray-500">{{ '@' . $user->username }}</p>
                </div>

                <!-- User Status Badges -->
                <div class="flex justify-center gap-6 mt-4">
                    <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-full">
                        <span class="{{ $user->is_active ? 'text-green-500' : 'text-gray-400' }}">
                            <i class="fas fa-circle text-xs"></i>
                        </span>
                        <span class="text-sm text-gray-600">
                            {{ $user->is_active ? 'نشط' : 'غير نشط' }}
                        </span>
                    </div>

                    @if($user->account_type)
                    <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-full">
                        <span class="text-blue-500">
                            <i class="fas fa-user-shield"></i>
                        </span>
                        <span class="text-sm text-gray-600">{{ $user->account_type }}</span>
                    </div>
                    @endif

                    @if($user->plan)
                    <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-full">
                        <span class="text-purple-500">
                            <i class="fas fa-crown"></i>
                        </span>
                        <span class="text-sm text-gray-600">{{ $user->plan }}</span>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center gap-4 mt-6">
                    <button class="px-6 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors duration-200 flex items-center gap-2">
                        <i class="fas fa-user-plus"></i>
                        <span>متابعة</span>
                    </button>
                    <button class="px-6 py-2 border border-gray-300 text-gray-700 rounded-full hover:bg-gray-50 transition-colors duration-200 flex items-center gap-2">
                        <i class="fas fa-envelope"></i>
                        <span>مراسلة</span>
                    </button>
                </div>
            </div>

            <!-- Cars Grid Section -->
            <div class="mt-12 px-4">
                <div class="max-w-5xl mx-auto">
                    <h2 class="text-xl font-bold mb-6 text-gray-900">السيارات المعروضة</h2>

                    <div class="grid gap-6">
                        @foreach ($cars as $car)
                        <div class="flex flex-col md:flex-row items-center bg-gray-50 rounded-xl p-4 hover:bg-gray-100 transition-colors duration-200">
                            <!-- Car Image -->
                            <div class="w-full md:w-48 h-48 md:h-32 flex-shrink-0 mb-4 md:mb-0">
                                <img src="{{ asset('storage/'.$car->images[0]) }}"
                                     class="w-full h-full object-cover rounded-lg shadow-sm"
                                     alt="{{ $car->title }}">
                            </div>

                            <!-- Car Details -->
                            <div class="flex-grow px-0 md:px-6">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $car->title }}</h3>
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mt-2">
                                    <span class="flex items-center gap-1">
                                        <i class="far fa-clock"></i>
                                        <span>قبل ١ ساعة</span>
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>الرياض</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-4 md:mt-0 md:mr-4">
                                <a href="{{ route('cars.show', $car) }}"
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    عرض التفاصيل
                                    <i class="fas fa-arrow-left mr-2"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $cars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles */
        body {
            direction: rtl;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
</x-app-layout>
