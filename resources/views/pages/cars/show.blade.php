<x-app-layout title="{{ $car->title }}">
    <div class="container mx-auto px-4 py-12 bg-gray-50 my-10">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Car Title -->
            <h1 class="text-4xl font-extrabold text-gray-900 text-center mt-6 mb-8">{{ $car->title }}</h1>

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
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <span class="block text-sm font-medium text-gray-500">السعر</span>
                            <span class="text-2xl font-bold text-gray-800">ريال {{ $car->price }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">الفئة</span>
                            <span class="text-xl text-gray-800">{{ $car->category->title }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">الهاتف</span>
                            <a href="tel:{{ $car->phone }}" class="text-lg text-blue-600 flex items-center gap-2">
                                <i class="fas fa-phone-alt"></i>
                                {{ $car->phone }}
                            </a>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">البريد الإلكتروني</span>
                            <a href="mailto:{{ $car->email }}" class="text-lg text-blue-600 flex items-center gap-2">
                                <i class="fas fa-envelope"></i>
                                {{ $car->email }}
                            </a>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">العنوان</span>
                            <span class="text-lg text-gray-800">{{ $car->address }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">المعلومات</span>
                            <span class="text-lg text-gray-800">{{ $car->info }}</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <span class="block text-sm font-medium text-gray-500">الوصف</span>
                        <p class="text-gray-700 leading-relaxed">
                            {{ Str::limit($car->description, 1000) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Seller Button -->
            <div class="p-8 text-center">
                <button class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-500 transition-all duration-300" onclick="openContactModal()">
                    اتصل بالبائع
                </button>
            </div>

            <!-- Car Features Section -->
            <div class="p-8 mt-8 bg-gray-100 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">أفضل سيارة بأداء مذهل وتصميم عصري</h2>
                <ul class="list-disc pl-6 text-gray-700 space-y-2">
                    <li>سهولة الاستخدام والتكامل مع جميع احتياجاتك اليومية.</li>
                    <li>مزايا متقدمة وأداء منقطع النظير.</li>
                    <li>سعر تنافسي يجعلها خياراً مثالياً للجميع.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Contact Seller Modal -->
    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 transition-all duration-300 ease-in-out flex ">
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
