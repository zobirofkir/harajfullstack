<x-app-layout title="{{ $car->title }}">
    <div class="container mx-auto px-4 py-12 bg-gray-50 my-10">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">

            <!-- Car Title -->
            <h1 class="text-4xl font-extrabold text-gray-900 text-center mt-6 mb-8">{{ $car->title }}</h1>

            <!-- User Info Section -->
            <div class="bg-gray-50 py-10">

                <div class="flex justify-center mb-8">
                    <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">معلومات البائع</h2>
                </div>

                <div class="max-w-7xl mx-auto p-8 bg-white rounded-xl shadow-lg flex flex-col md:flex-row justify-between items-center md:space-x-12 space-y-6 md:space-y-0">

                    <!-- User Info Details -->
                    <div class="text-center md:text-left space-y-6">
                        <h3 class="text-3xl font-semibold text-gray-900">{{ $car->user->name }}</h3>
                        <p class="text-lg text-gray-700">{{ $car->user->email }}</p>
                        <p class="text-sm text-gray-600">تم الإضافة في: {{ date('M d, Y', strtotime($car->created_at)) }}</p>

                        <!-- User Location -->
                        <p id="user-location" class="text-sm text-gray-600 flex items-center gap-4 justify-center md:justify-start">
                            <i class="fas fa-map-marker-alt mr-2 text-xl text-gray-500"></i> السعودية
                        </p>
                    </div>

                    <!-- Social Share Icons -->
                    <div class="flex space-x-6">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                           class="text-blue-600 hover:text-blue-800 transition-colors duration-300 ml-6">
                            <i class="fab fa-facebook-f text-3xl"></i>
                        </a>

                        <a href="https://www.instagram.com/?url={{ urlencode(url()->current()) }}" target="_blank"
                           class="text-pink-600 hover:text-pink-800 transition-colors duration-300">
                            <i class="fab fa-instagram text-3xl"></i>
                        </a>

                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank"
                           class="text-blue-400 hover:text-blue-600 transition-colors duration-300">
                            <i class="fab fa-twitter text-3xl"></i>
                        </a>

                        <a href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank"
                           class="text-green-500 hover:text-green-700 transition-colors duration-300">
                            <i class="fab fa-whatsapp text-3xl"></i>
                        </a>
                    </div>

                </div>
            </div>

            <!-- Popup Modal -->
            <div id="popup-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm text-center">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">هل ترغب في تمكين الوصول إلى الموقع؟</h3>
                    <p class="text-gray-600 mb-4">لنتمكن من تقديم أفضل تجربة، نحتاج إلى الوصول إلى موقعك.</p>
                    <button id="accept-location" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-all duration-300">نعم، سمح بذلك</button>
                    <button id="decline-location" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition-all duration-300 mt-2">لا، رفض</button>
                </div>
            </div>
            <!-- Car Details Section -->
            <div class="p-8 bg-white rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Section -->
                    <div class="space-y-8">
                        <!-- Price -->
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm flex items-center gap-2">
                            <i class="fas fa-tag text-xl text-gray-500"></i>
                            <span class="block text-sm font-medium text-gray-500">السعر</span>
                            <span class="text-3xl font-bold text-gray-900 whitespace-nowrap overflow-hidden">ريال {{ $car->price }}</span>
                        </div>

                        <!-- Old Price -->
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm flex items-center gap-2">
                            <i class="fas fa-arrow-down text-xl text-gray-500"></i>
                            <span class="block text-sm font-medium text-gray-500">السعر القديم</span>
                            <span class="font-semibold text-gray-400 line-through">ريال {{ $car->old_price ?? $car->price }}</span>
                        </div>

                        <!-- Category -->
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm flex items-center gap-2">
                            <i class="fas fa-cogs text-xl text-gray-500"></i>
                            <span class="block text-sm font-medium text-gray-500">الفئة</span>
                            <span class="text-xl font-semibold text-gray-900">{{ $car->category->title }}</span>
                        </div>

                        <!-- Gasoline Type -->
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm flex items-center gap-2">
                            <i class="fas fa-gas-pump text-xl text-gray-500"></i>
                            <span class="block text-sm font-medium text-gray-500">نوع البنزين</span>
                            <span class="text-xl font-semibold text-gray-900">{{ $car->gasoline->type }}</span>
                        </div>

                    </div>

                    <!-- Right Section -->
                    <div class="space-y-6">
                        <!-- Phone -->
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                            <span class="block text-sm font-medium text-gray-500">الهاتف</span>
                            <a href="tel:{{ $car->phone }}" class="text-lg text-center flex justify-center items-center gap-2 bg-gray-100 rounded-lg p-2">
                                <i class="fas fa-phone-alt"></i>
                                رقم الهاتف
                            </a>
                        </div>

                        <!-- Email -->
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                            <span class="block text-sm font-medium text-gray-500">البريد الإلكتروني</span>
                            <a href="mailto:{{ $car->email }}" class="text-lg text-center flex justify-center items-center gap-2 bg-gray-100 rounded-lg p-2">
                                <i class="fas fa-envelope"></i>
                                البريد الإلكتروني
                            </a>
                        </div>

                        <!-- Address -->
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                            <span class="block text-sm font-medium text-gray-500">العنوان</span>
                            <span class="text-lg text-gray-900">{{ $car->address }}</span>
                        </div>

                        <!-- Info -->
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                            <span class="block text-sm font-medium text-gray-500">معلومات السيارة</span>
                            <span class="text-lg text-gray-900">{{ $car->info }}</span>
                        </div>

                        <!-- Description -->
                        <div class="p-4 bg-gray-50 rounded-lg shadow-sm">
                            <span class="block text-sm font-medium text-gray-500">وصف السيارة</span>
                            <span class="text-lg text-gray-900">{{ $car->description }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Image Display Section -->
            <div class="flex flex-col items-center justify-center w-full">
                <div id="imageCarousel" class="relative w-auto h-auto">
                    <div class="h-auto w-auto flex flex-col items-center justify-center">
                        @foreach ($car->images as $image)
                            <img src="{{ asset('storage/' . $image) }}"
                                alt="صورة السيارة"
                                class="w-auto h-auto object-cover rounded-lg shadow-lg transition-all duration-300 ease-in-out mb-4">
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Contact Seller Buttons -->
            <div class="p-8 text-center flex md:flex-row flex-col justify-center gap-4 mt-8">
                <!-- Contact Seller Modal Button -->
                <button class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-500 transition-all duration-300 whitespace-nowrap" onclick="openContactModal()">
                    اتصل بالبائع
                </button>

                <!-- Phone Contact Button -->
                <a href="tel:{{ $car->phone }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-500 transition-all duration-300 flex items-center gap-2 whitespace-nowrap flex justify-center">
                    <i class="fas fa-phone-alt"></i>
                    اتصل الآن
                </a>

                <!-- Email Contact Button -->
                <a href="mailto:{{ $car->email }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-500 transition-all duration-300 flex items-center gap-2 whitespace-nowrap flex justify-center">
                    <i class="fas fa-envelope"></i>
                    أرسل بريدًا إلكترونيًا
                </a>
            </div>

            <!-- Image Gallery Section -->
            <div class="mt-12 px-4 py-6 bg-gray-50">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">معرض الصور</h2>
                <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($car->images as $image)
                        <div class="relative max-w-xl">
                            <img src="{{ asset('storage/'.$image) }}" alt="صورة السيارة" class="w-full h-full object-cover rounded-lg shadow-lg cursor-pointer hover:opacity-80 transition-all duration-300">
                        </div>
                    @endforeach
                </div>
            </div>

            @php
                $categories = App\Services\Facades\CategoryFacade::index()['categories'];
            @endphp

            <div class="text-start mb-8">
                <h1 class="text-2xl font-semibold text-gray-800 mb-6 mr-4">الفئات</h1>
            </div>

            <div class="flex flex-wrap justify-center gap-6 px-4 sm:px-6 lg:px-8">
                @foreach ($categories->take(10) as $category)
                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5">
                        <a href="{{ route('categories.show', $category->slug) }}">
                            <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105">
                                <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->title }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h2 class="text-xl font-semibold text-gray-800 truncate">{{ $category->title }}</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
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
