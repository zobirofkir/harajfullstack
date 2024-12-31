<x-app-layout title="{{ $car->title }}">
    <div class="container mx-auto px-4 py-12 mb-10">

        <div class="flex justify-start -mt-12">
            <a href="{{url('/')}}" class="flex items-center px-4 py-2 text-gray-400 rounded-lg transition duration-300">
                <i class="fas fa-arrow-right mr-2 text-4xl"></i>
            </a>
        </div>

            <!-- User Info Section -->
            <div class="flex flex-col gap-6 md:px-10 px-8 bg-blue-100 rounded-md py-2 mt-4">

                <div class="flex justify-start mt-2">
                    <h1 class="text-xl text-gray-400 font-extrabold text-start">
                        {{ $car->title }}
                    </h1>
                </div>

                <div class="flex justify-between items-center w-full gap-4">
                    <div class="w-full md:w-auto">
                        <h3 class="font-semibold text-gray-400 md:text-xl text-md text-center md:text-start flex items-center gap-4 overflow-hidden whitespace-nowrap">
                            <i class="fas fa-map-marker-alt text-xl text-gray-400"></i>
                            {{ Str::limit($car->user->location ?? 'السعودية', 15) }}
                        </h3>
                    </div>

                    <div class="w-full md:w-auto">
                        <p class="md:text-xl text-md text-gray-400 text-center md:text-start flex items-center gap-4 whitespace-nowrap">
                            <i class="fas fa-calendar-days text-xl text-gray-400"></i>
                            {{ Carbon\Carbon::parse($car->created_at)->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-between w-full">
                    <div class="flex flex-row items-center gap-6">
                        <img src="{{ $car->user->image ? asset('storage/' . $car->user->image) : 'https://icons.iconarchive.com/icons/icons8/windows-8/512/Users-Guest-icon.png' }}" alt="{{ $car->title }}" class="rounded-full object-cover w-20 h-20">
                    </div>
                </div>
            </div>



            <div class="bg-white rounded-lg shadow-lg overflow-hidden">

                <!-- Car Details Section -->
                <div class="p-8 bg-white rounded-lg">

                    <!-- Car Info Section -->
                    <div class="mb-2 rounded-lg flex flex-col items-start gap-4 transition-shadow duration-300 ease-in-out">
                        <span class="md:text-lg text-md text-gray-400 font-medium">{{ $car->info }}</span>
                    </div>

                    <div class="mb-2 rounded-lg flex flex-col items-start gap-4 transition-shadow duration-300 ease-in-out">
                        <span class="md:text-lg text-md text-gray-400 font-medium">{{ $car->category->title }}</span>
                    </div>

                    <!-- Address Section -->
                    <div class="mb-2 rounded-lg flex flex-col items-start gap-4 transition-shadow duration-300 ease-in-out">
                        <span class="md:text-lg text-md text-gray-400 font-medium">{{ $car->address }}</span>
                    </div>

                    <!-- Gasoline Type Section -->
                    <div class="mb-2 rounded-lg flex flex-col items-start gap-4 transition-shadow duration-300 ease-in-out">
                        <span class="md:text-lg text-md text-gray-400 font-medium">{{ $car->gasoline->type }}</span>
                    </div>

                    <!-- Car Description Section -->
                    <div class="mb-2 rounded-lg flex flex-col items-start gap-4 transition-shadow duration-300 ease-in-out">
                        <span class="md:text-lg text-md text-gray-400 font-medium">{{ $car->description }}</span>
                    </div>

                    <div class="mb-2 rounded-lg flex flex-col items-start gap-4 transition-shadow duration-300 ease-in-out">
                        <span class="md:text-lg text-md text-gray-400 font-medium">{{ $car->price }} ريال</span>
                    </div>

                    <div class="mb-2 rounded-lg flex flex-col items-start gap-4 transition-shadow duration-300 ease-in-out">
                        <span class="md:text-lg text-md text-gray-400 font-medium line-through">ريال {{ $car->old_price ?? $car->price }}</span>
                    </div>

                </div>

                <!-- Main Image Display Section -->
                <div class="flex flex-col items-center justify-center w-full">
                    <div id="imageCarousel" class="relative w-auto h-auto">
                        <div class="h-auto w-auto flex flex-col items-start justify-center">
                            @foreach ($car->images as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="صورة السيارة" class="w-full h-auto object-cover rounded-lg shadow-lg transition-all duration-300 ease-in-out mb-4">
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Contact Seller Buttons -->
                <div class="p-8 flex flex-col justify-start gap-6 md:max-w-[20%] max-w-[65%] mt-8 ">
                    <button class="bg-blue-600 text-white px-2 py-2 rounded-lg hover:bg-gradient-to-l from-gray-500 via-gray-600 to-gray-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg flex items-center gap-3 whitespace-nowrap justify-center" onclick="openContactModal()">
                        <i class="fas fa-user"></i>
                        اتصل
                    </button>

                    <!-- Chat Button -->

                    <a href="{{ route('chats.show', ['userName' => $car->user->name, 'carId' => $car->id]) }}"
                        class="bg-gray-600 text-white px-2 py-2 rounded-lg hover:bg-gradient-to-l from-gray-500 via-gray-600 to-gray-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg flex items-center gap-3 whitespace-nowrap justify-center">
                         <i class="fas fa-comments"></i>
                         بدء الدردشة
                     </a>
                </div>
            </div>

        </div>

        <div class="container mx-auto my-10 bg-gray-100 shadow-xl p-2 rounded-lg">
            <div class="flex flex-col items-center justify-between w-full gap-8 overflow-x-auto overflow-y-hidden md:px-4 px-0">
                <div class="flex flex-row items-center gap-4 text-gray-400 cursor-pointer mb-2 mt-2 justify-start" onclick="openContactModal()">
                    <i class="fas fa-user text-sm"></i>
                    <h2>
                        مراسلة
                    </h2>
                </div>
                <div class="flex flex-row items-center gap-4 text-gray-400 cursor-pointer mb-2 mt-2 justify-start" onclick="toggleFavorite(this)">
                    <i class="fas fa-heart text-sm" id="heart-icon"></i>
                    <h2>تفضيل</h2>
                </div>
                <div class="flex flex-row items-center gap-4 text-gray-400 cursor-pointer mb-2 mt-2 justify-start" onclick="copyToClipboard('{{ route('cars.show', $car->slug) }}')">
                    <i class="fas fa-share text-sm"></i>
                    <h2>
                        مشاركة
                    </h2>
                </div>
                <div class="flex flex-row items-center gap-4 text-gray-400 cursor-pointer mb-2 mt-2 justify-start">
                    <i class="fas fa-phone text-sm"></i>
                    <h2>
                        تواصل
                    </h2>
                </div>
            </div>
        </div>

    @php
        $cars = App\Services\Facades\CarFacade::index()['cars'];
    @endphp

    <div class="container mx-auto my-10 px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">عروض مشابهة</h2>
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($cars->take(10) as $car)
            <a href="{{ route('cars.show', $car->slug) }}" class="block rounded-lg overflow-hidden shadow-md hover:shadow-2xl transition-all">
                <div class="bg-white p-4">
                    <div class="text-start">
                        <h1 class="text-xl font-semibold text-gray-800">{{ $car->title }}</h1>
                    </div>
                    <div class="h-48 lg:h-64 mx-auto mt-2">
                        <img src="{{ asset('storage/'.$car->images[0]) }}" alt="{{ $car->title }}" class="w-full h-full object-cover rounded-md">
                    </div>
                    <div class="text-end mt-2">
                        <p class="text-lg font-medium text-gray-600">{{ $car->price }} ريال</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>


    <!-- Contact Seller Modal -->
    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 transition-all duration-300 ease-in-out flex">
        <div class="relative bg-white p-8 rounded-lg max-w-md w-full space-y-6">
            <button class="absolute top-4 right-4 text-2xl text-gray-800 hover:text-gray-600" onclick="closeContactModal()">×</button>
            <h2 class="text-2xl font-bold text-gray-800">اتصل بالبائع</h2>
            <form action="{{ route('contact.seller') }}" method="POST">
                @csrf
                <input type="hidden" name="car_id" value="{{ $car->id }}">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">الاسم</label>
                    <input type="text" id="name" class="w-full p-2 border rounded-lg mt-2" placeholder="أدخل اسمك" name="name" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">البريد الإلكتروني</label>
                    <input type="email" id="email" class="w-full p-2 border rounded-lg mt-2" placeholder="أدخل بريدك الإلكتروني" name="email" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700">رقم الهاتف</label>
                    <input type="text" id="phone" class="w-full p-2 border rounded-lg mt-2" placeholder="أدخل رقم هاتفك" name="phone" required>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700">الرسالة</label>
                    <textarea id="message" class="w-full p-2 border rounded-lg mt-2" rows="4" placeholder="أدخل رسالتك" name="message" required></textarea>
                </div>
                <button type="submit" class="w-full bg-gray-600 text-white p-2 rounded-lg hover:bg-gray-500 transition-all duration-300">إرسال</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                }).showToast();
            });
        </script>
    @endif

    <script>
        function showLoginModal() {
            document.getElementById('loginModal').classList.remove('hidden');
        }

        function closeLoginModal() {
            document.getElementById('loginModal').classList.add('hidden');
        }
    </script>

    <script>
        let currentImageIndex = 0;
        const images = @json($car->images);
        const mainImage = document.getElementById('mainImage');
        const prevButton = document.getElementById('prevImage');
        const nextButton = document.getElementById('nextImage');
        const contactModal = document.getElementById('contactModal');

        prevButton.addEventListener('click', () => {
            currentImageIndex = (currentImageIndex > 0) ? currentImageIndex - 1 : images.length - 1;
            mainImage.src = "{{ asset('storage/') }}" + '/' + images[currentImageIndex];
        });

        nextButton.addEventListener('click', () => {
            currentImageIndex = (currentImageIndex < images.length - 1) ? currentImageIndex + 1 : 0;
            mainImage.src = "{{ asset('storage/') }}" + '/' + images[currentImageIndex];
        });

        function openContactModal() {
            contactModal.classList.remove('hidden');
        }

        function closeContactModal() {
            contactModal.classList.add('hidden');
        }
    </script>
</x-app-layout>
