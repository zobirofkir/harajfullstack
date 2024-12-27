<x-app-layout title="{{ $car->title }}">
    <div class="container mx-auto px-4 py-12 bg-gray-50 my-10">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="relative">

                <div class="flex items-center justify-between space-x-4">
                    <button class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700 transition-all duration-300" id="prevImage">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="overflow-hidden w-full">
                        <div class="flex space-x-4 py-4 transition-all duration-500 ease-in-out transform hover:scale-105" id="imageCarousel">
                            @foreach ($car->images as $index => $image)
                                <img class="w-32 h-32 object-cover rounded-lg cursor-pointer hover:scale-110 transition-all duration-300 ease-in-out"
                                     src="{{ asset('storage/'.$image) }}"
                                     alt="صورة السيارة"
                                     data-index="{{ $index }}"
                                     onclick="openImageModal('{{ asset('storage/'.$image) }}')">
                            @endforeach
                        </div>
                    </div>
                    <button class="bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700 transition-all duration-300" id="nextImage">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>


                <div class="relative mt-4">
                    <img id="mainImage" class="w-full h-96 object-cover rounded-lg transition-all duration-300 ease-in-out"
                         src="{{ asset('storage/'.$car->images[0]) }}" alt="صورة السيارة">
                </div>
            </div>


            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <p class="text-xl text-gray-800"><strong>السعر:</strong> ${{ $car->price }}</p>
                        <p class="text-xl text-gray-800"><strong>الفئة:</strong> {{ $car->category->name }}</p>
                        <p class="text-xl text-gray-800 flex flex-col gap-4">
                            <strong>الهاتف:</strong>
                            <a href="tel:{{ $car->phone }}" class="flex items-center gap-4 text-gray-500">
                                <i class="fas fa-phone-alt"></i>
                                <span>{{ $car->phone }}</span>
                            </a>
                        </p>
                        <p class="text-xl text-gray-800 flex flex-col gap-4">
                            <strong>البريد الإلكتروني:</strong>
                            <a href="mailto:{{ $car->email }}" class="flex items-center gap-4 text-gray-500">
                                <i class="fas fa-envelope"></i>
                                <span>{{ $car->email }}</span>
                            </a>
                        </p>
                        <p class="text-xl text-gray-800"><strong>العنوان:</strong> {{ $car->address }}</p>
                        <p class="text-xl text-gray-800"><strong>المعلومات:</strong> {{ $car->info }}</p>
                    </div>

                    <div class="space-y-4 flex flex-col">
                        <p class="text-xl text-gray-800"><strong>الوصف:</strong></p>
                        <p class="text-lg text-gray-600 break-words whitespace-pre-wrap">
                            {{ Str::limit($car->description, 1000) }}
                        </p>
                    </div>
                </div>
            </div>


            <div class="p-8 text-center">
                <button class="bg-gray-600 text-white p-4 rounded-lg hover:bg-gray-500 transition-all duration-300" onclick="openContactModal()">اتصل بالبائع</button>
            </div>


            <div class="p-8 mt-8 bg-blue-100 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">أفضل وأسهل ومنطقي</h2>
                <div class="space-y-4">
                    <p class="text-lg text-gray-600">هذا القسم مخصص لتوضيح المزايا المذهلة للسيارة، بما في ذلك الأداء القوي، السعر التنافسي، والتصميم العصري.</p>
                    <ul class="list-disc pl-6 text-gray-800">
                        <li>سهولة الاستخدام والتكامل مع جميع احتياجاتك اليومية.</li>
                        <li>مزايا متقدمة وأداء منقطع النظير.</li>
                        <li>سعر تنافسي يجعلها خياراً مثالياً للجميع.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 transition-all duration-300 ease-in-out flex">
        <div class="relative bg-white p-8 rounded-lg max-w-md w-full space-y-6">
            <button class="absolute top-4 right-4 text-2xl text-gray-800 hover:text-gray-600" onclick="closeImageModal()">×</button>
            <img id="modalImage" class="w-full h-96 object-cover rounded-lg" src="" alt="صورة السيارة">
        </div>
    </div>

    <!-- Contact Seller Modal -->
    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 transition-all duration-300 ease-in-out flex ">
        <div class="relative bg-white p-8 rounded-lg max-w-md w-full space-y-6">
            <button class="absolute top-4 right-4 text-2xl text-gray-800 hover:text-gray-600" onclick="closeContactModal()">×</button>
            <h2 class="text-2xl font-bold text-gray-800">اتصل بالبائع</h2>
            <form>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">الاسم</label>
                    <input type="text" id="name" class="w-full p-2 border rounded-lg mt-2" placeholder="أدخل اسمك">
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700">الرسالة</label>
                    <textarea id="message" class="w-full p-2 border rounded-lg mt-2" rows="4" placeholder="أدخل رسالتك"></textarea>
                </div>
                <button type="submit" class="w-full bg-gray-600 text-white p-2 rounded-lg hover:bg-gray-500 transition-all duration-300">إرسال</button>
            </form>
        </div>
    </div>

    <script>
        let currentImageIndex = 0;
        const images = @json($car->images);
        const mainImage = document.getElementById('mainImage');
        const prevButton = document.getElementById('prevImage');
        const nextButton = document.getElementById('nextImage');
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const contactModal = document.getElementById('contactModal');

        prevButton.addEventListener('click', () => {
            currentImageIndex = (currentImageIndex > 0) ? currentImageIndex - 1 : images.length - 1;
            mainImage.src = "{{ asset('storage/') }}" + '/' + images[currentImageIndex];
        });

        nextButton.addEventListener('click', () => {
            currentImageIndex = (currentImageIndex < images.length - 1) ? currentImageIndex + 1 : 0;
            mainImage.src = "{{ asset('storage/') }}" + '/' + images[currentImageIndex];
        });

        function openImageModal(imageUrl) {
            modal.classList.remove('hidden');
            modalImage.src = imageUrl;
        }

        function closeImageModal() {
            modal.classList.add('hidden');
        }

        function openContactModal() {
            contactModal.classList.remove('hidden');
        }

        function closeContactModal() {
            contactModal.classList.add('hidden');
        }
    </script>
</x-app-layout>
