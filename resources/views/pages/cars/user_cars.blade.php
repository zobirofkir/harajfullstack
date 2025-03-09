<x-app-layout title="{{ $user->name }} - السيارات">
    <div class="container mx-auto px-4 py-8 lg:py-12">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Profile Header Section -->
            <div class="relative">
                <!-- Banner Image with Gradient Overlay -->
                <div class="w-full h-[150px] md:h-[400px] relative">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-black/60"></div>
                    <img src="{{ $user->cover_photo ? asset('storage/' . $user->cover_photo) : ($user->cars->first() ? asset('storage/' . $user->cars->first()->images[0]) : asset('images/kings-banner.jpg')) }}"
                         class="w-full h-full object-cover"
                         alt="{{ $user->name }}">
                </div>

                <!-- Profile Info Overlay -->
                <div class="absolute -bottom-20 w-full flex flex-col items-center">
                    <!-- Profile Image -->
                    <div class="w-36 h-36 rounded-full ring-4 ring-white shadow-lg overflow-hidden bg-white">
                        <img src="{{ $user->image ? asset('storage/' . $user->image) : 'https://icons.iconarchive.com/icons/icons8/windows-8/512/Users-Guest-icon.png' }}"
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


                <!-- Action Buttons -->
                <div class="flex justify-center gap-4 mt-6">
                    @auth
                        @if(auth()->id() !== $user->id)
                            <button
                                onclick="toggleFollow({{ $user->id }})"
                                class="follow-btn px-6 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors duration-200 flex items-center gap-2"
                                data-following="{{ auth()->user()->isFollowing($user) ? 'true' : 'false' }}"
                            >
                                <i class="fas fa-user-plus"></i>
                                <span>{{ auth()->user()->isFollowing($user) ? 'إلغاء المتابعة' : 'متابعة' }}</span>
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors duration-200 flex items-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            <span>متابعة</span>
                        </a>
                    @endauth

                    <button class="px-6 py-2 border border-gray-300 text-gray-700 rounded-full hover:bg-gray-50 transition-colors duration-200 flex items-center gap-2">
                        <a href="{{ route('chats.index') }}">
                            <i class="fas fa-envelope"></i>
                            <span>مراسلة</span>
                        </a>
                    </button>
                </div>
            </div>

            <!-- Cars Grid Section -->
            <div class="mt-12 px-4">
                <div class="max-w-5xl mx-auto">
                    <h2 class="text-xl font-bold mb-6 text-gray-900">السيارات المعروضة</h2>

                    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                        @foreach ($cars as $car)
                        <div class="flex flex-col bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-200 overflow-hidden border border-gray-100">
                            <!-- Car Image -->
                            <div class="relative w-full aspect-[4/3] flex-shrink-0">
                                <img src="{{ asset('storage/'.$car->images[0]) }}"
                                     class="w-full h-full object-cover"
                                     alt="{{ $car->title }}">
                                <div class="absolute top-3 right-3">
                                    <span class="bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full text-sm font-medium text-gray-700 shadow-sm">
                                        {{ Carbon\Carbon::parse($car->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                            </div>

                            <!-- Car Details -->
                            <div class="flex-grow md:p-4 p-0 space-y-3 flex flex-col justify-center items-center">
                                <h3 class="text-lg font-semibold text-gray-900 line-clamp-1 mt-2">{{ Str::limit($car->title, 8) }}</h3>
                                <div class="flex flex-col space-y-2 text-sm text-gray-500">
                                    <span class="inline-flex items-center gap-2 md:block hidden">
                                        <i class="far fa-clock text-gray-400 w-4"></i>
                                        <span>نُشر {{ Carbon\Carbon::parse($car->created_at)->diffForHumans() }}</span>
                                    </span>
                                    <span class="inline-flex items-center gap-2 md:block hidden">
                                        <i class="fas fa-pen-to-square text-gray-400 w-4"></i>
                                        <span>تحديث {{ Carbon\Carbon::parse($car->updated_at)->diffForHumans() }}</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="p-4 pt-0">
                                <a href="{{ route('cars.show', $car->slug) }}"
                                   class="group inline-flex items-center justify-center w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 hover:border-gray-300 transition-all duration-200 whitespace-nowrap">
                                    عرض التفاصيل
                                    <i class="fas fa-arrow-left mr-2 group-hover:translate-x-1 transition-transform duration-200"></i>
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

    @push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            window.toggleFollow = function(userId) {
                fetch(`/follow/${userId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const btn = document.querySelector('.follow-btn');
                        const span = btn.querySelector('span');
                        const icon = btn.querySelector('i');

                        if (data.isFollowing) {
                            span.textContent = 'إلغاء المتابعة';
                            btn.dataset.following = 'true';
                            btn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                            btn.classList.add('bg-gray-500', 'hover:bg-gray-600');
                        } else {
                            span.textContent = 'متابعة';
                            btn.dataset.following = 'false';
                            btn.classList.remove('bg-gray-500', 'hover:bg-gray-600');
                            btn.classList.add('bg-blue-500', 'hover:bg-blue-600');
                        }

                        // Show success message using a nicer alert (you can customize this)
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                        alertDiv.textContent = data.message;
                        document.body.appendChild(alertDiv);

                        // Remove alert after 3 seconds
                        setTimeout(() => {
                            alertDiv.remove();
                        }, 3000);
                    } else {
                        // Show error message
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                        alertDiv.textContent = data.message;
                        document.body.appendChild(alertDiv);

                        // Remove alert after 3 seconds
                        setTimeout(() => {
                            alertDiv.remove();
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Show error message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                    alertDiv.textContent = 'حدث خطأ أثناء تنفيذ العملية';
                    document.body.appendChild(alertDiv);

                    // Remove alert after 3 seconds
                    setTimeout(() => {
                        alertDiv.remove();
                    }, 3000);
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
