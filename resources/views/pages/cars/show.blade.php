<x-app-layout title="{{ $car->title }}">
    <div class="container mx-auto px-4 py-12 bg-gray-50 my-10">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">

            <!-- Car Title -->
            <h1 class="text-4xl font-extrabold text-gray-900 text-center mt-6 mb-8">{{ $car->title }}</h1>

            <!-- User Info Section -->

            <div class="bg-gray-100">

                <div class="flex justify-center">
                    <h2 class="text-2xl font-semibold text-gray-800 mt-4">معلومات المستخدم</h2>
                </div>

                <div class="p-6 rounded-lg mb-8 shadow-md flex flex-col md:flex-row justify-between items-center w-full space-y-6 md:space-y-0">
                    <div class="space-y-4 text-center md:text-left">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $car->user->name }}</h3>
                        <p class="text-lg text-gray-600">{{ $car->user->email }}</p>
                        <p class="text-sm text-gray-500">تم الإضافة في: {{ date('M d, Y', strtotime($car->created_at)) }}</p>
                    </div>

                    <div class="flex justify-center space-x-6 mt-6 md:mt-0">
                        <!-- Share on Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition-colors duration-300 ml-6">
                            <i class="fab fa-facebook-f text-2xl"></i>
                        </a>

                        <!-- Share on Instagram -->
                        <a href="https://www.instagram.com/?url={{ urlencode(url()->current()) }}" target="_blank" class="text-pink-600 hover:text-pink-800 transition-colors duration-300">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>

                        <!-- Share on Twitter -->
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank" class="text-blue-400 hover:text-blue-600 transition-colors duration-300">
                            <i class="fab fa-twitter text-2xl"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Main Image Display Section -->
            <div class="relative">
                <div id="imageCarousel" class="relative">
                    <div class="max-w-4xl mx-auto">
                        <img id="mainImage"
                             src="{{ asset('storage/'.$car->images[0]) }}"
                             alt="صورة السيارة"
                             class="w-full h-full object-cover rounded-lg shadow-lg transition-all duration-300 ease-in-out">
                    </div>
                    <!-- Navigation Buttons -->
                    <button id="prevImage"
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-100 hover:bg-gray-200 p-3 rounded-full shadow-lg">
                        <i class="fas fa-chevron-left text-lg text-gray-600"></i>
                    </button>
                    <button id="nextImage"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-100 hover:bg-gray-200 p-3 rounded-full shadow-lg">
                        <i class="fas fa-chevron-right text-lg text-gray-600"></i>
                    </button>
                </div>
            </div>

            <!-- Car Details Section -->
            <div class="p-8 bg-white shadow-md rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Section -->
                    <div class="space-y-6">
                        <!-- Price -->
                        <div>
                            <span class="block text-sm font-medium text-gray-400">السعر</span>
                            <span class="text-3xl font-semibold text-gray-800">ريال {{ $car->price }}</span>
                        </div>

                        <!-- Old Price -->
                        <div>
                            <span class="block text-sm font-medium text-gray-400">السعر القديم</span>
                            <span class="font-bold text-gray-500 line-through">ريال {{ $car->old_price ?? $car->price }}</span>
                        </div>

                        <!-- Category -->
                        <div>
                            <span class="block text-sm font-medium text-gray-400">الفئة</span>
                            <span class="text-xl font-medium text-gray-800">{{ $car->category->title }}</span>
                        </div>

                        <!-- Gasoline Type -->
                        <div>
                            <span class="block text-sm font-medium text-gray-400">نوع البنزين</span>
                            <span class="text-xl text-gray-800">{{ $car->gasoline->type }}</span>
                        </div>

                        <!-- Phone -->
                        <div>
                            <span class="block text-sm font-medium text-gray-400">الهاتف</span>
                            <a href="tel:{{ $car->phone }}" class="text-lg text-gray-600 hover:text-gray-800 flex items-center gap-2">
                                <i class="fas fa-phone-alt"></i>
                                {{ $car->phone }}
                            </a>
                        </div>

                        <!-- Email -->
                        <div>
                            <span class="block text-sm font-medium text-gray-400">البريد الإلكتروني</span>
                            <a href="mailto:{{ $car->email }}" class="text-lg text-gray-600 hover:text-gray-800 flex items-center gap-2">
                                <i class="fas fa-envelope"></i>
                                {{ $car->email }}
                            </a>
                        </div>

                        <!-- Address -->
                        <div>
                            <span class="block text-sm font-medium text-gray-400">العنوان</span>
                            <span class="text-lg text-gray-800">{{ $car->address }}</span>
                        </div>

                        <!-- Info -->
                        <div>
                            <span class="block text-sm font-medium text-gray-400">المعلومات</span>
                            <span class="text-lg text-gray-800">{{ $car->info }}</span>
                        </div>
                    </div>

                    <!-- Right Section -->
                    <div class="space-y-4">

                        <div>
                            <span class="block text-sm font-medium text-gray-400">الوصف</span>
                            <p class="text-gray-600 leading-relaxed text-lg">
                                {{ Str::limit($car->description, 1000) }}
                            </p>
                        </div>

                        <div class="p-8 flex justify-center space-x-6 mt-8">
                            <!-- Share on Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="text-blue-600 hover:text-blue-800 ml-6">
                                <i class="fab fa-facebook-f text-2xl"></i>
                            </a>

                            <!-- Share on Instagram -->
                            <a href="https://www.instagram.com/?url={{ urlencode(url()->current()) }}" target="_blank" class="text-pink-600 hover:text-pink-800">
                                <i class="fab fa-instagram text-2xl"></i>
                            </a>

                            <!-- Share on Twitter -->
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                                <i class="fab fa-twitter text-2xl"></i>
                            </a>

                        </div>

                    </div>

                </div>
            </div>

            <!-- Image Gallery Section -->
            <div class="mt-12 px-4 py-6 bg-gray-50">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">معرض الصور</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($car->images as $image)
                        <div class="relative">
                            <img src="{{ asset('storage/'.$image) }}" alt="صورة السيارة" class="w-full h-40 object-cover rounded-lg shadow-lg cursor-pointer hover:opacity-80 transition-all duration-300">
                        </div>
                    @endforeach
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
