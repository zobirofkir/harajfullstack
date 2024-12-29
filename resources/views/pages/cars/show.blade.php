<x-app-layout title="{{ $car->title }}">
    <div class="container mx-auto px-4 py-12 bg-gray-50 my-10">

        <div class="flex justify-start -mt-20">
            <a href="{{url('/')}}" class="flex items-center px-4 py-2 text-gray-400 rounded-lg transition duration-300">
                <i class="fas fa-arrow-right mr-2 text-4xl"></i>
            </a>
        </div>


            <!-- User Info Section -->
            <div class="flex flex-col gap-6 md:px-10 px-8 bg-blue-100 rounded-md py-2">
                <div class="flex justify-start mt-2">
                    <h1 class="text-xl font-extrabold text-start">
                        {{ $car->title }}
                    </h1>
                </div>

                <div class="flex justify-between items-center w-full">
                    <div class="w-full md:w-auto">
                        <h3 class="text-md font-semibold text-gray-900 text-center md:text-start flex items-center gap-4 overflow-hidden">
                            <i class="fas fa-map-marker-alt text-xl text-gray-500"></i>
                            {{ $car->address}}
                        </h3>
                    </div>

                    <div class="w-full md:w-auto">
                        <p class="text-lg text-gray-600 text-center md:text-start flex items-center gap-4">
                            <i class="fas fa-calendar-days text-xl text-gray-500"></i>
                            {{ Carbon\Carbon::parse($car->created_at)->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-between w-full">
                    <div class="flex flex-row items-center gap-6">
                        <img src="{{ asset('storage/'.$car->user->image) }}" alt="{{ $car->title }}" class="rounded-full w-20 h-20">

                        <a href="{{$car->user->phone}}" class="flex flex-row items-center gap-4 bg-blue-500 py-2 px-4 rounded-full text-white text-center">
                            <i class="fas fa-phone text-xl"></i>
                            تواصل
                        </a>
                    </div>
                </div>
            </div>



        <div class="bg-white rounded-lg shadow-lg overflow-hidden">

            <!-- Car Details Section -->
            <div class="p-8 bg-white rounded-lg">

                    <div class="p-4 rounded-lg flex md:flex-row flex-col items-center gap-2">
                        <span class="text-3xl font-bold text-gray-900 whitespace-nowrap overflow-hidden">ريال {{ $car->price }}</span>
                    </div>

                    <div class="p-4 rounded-lg flex md:flex-row flex-col items-center gap-2">
                        <span class="font-semibold text-gray-400 line-through">ريال {{ $car->old_price ?? $car->price }}</span>
                    </div>

                    <div class="p-4 rounded-lg flex md:flex-row flex-col items-center gap-2">
                        <span class="text-xl font-semibold text-gray-900">{{ $car->category->title }}</span>
                    </div>

                    <!-- Address Section -->
                    <div class="p-6 rounded-lg flex md:flex-row flex-col items-center gap-4 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                        <span class="text-lg text-gray-900 font-medium">{{ $car->address }}</span>
                    </div>

                    <!-- Car Info Section -->
                    <div class="p-6 rounded-lg flex md:flex-row flex-col items-center gap-4 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                        <span class="text-lg text-gray-900 font-medium">{{ $car->info }}</span>
                    </div>

                    <!-- Gasoline Type Section -->
                    <div class="p-6 rounded-lg flex md:flex-row flex-col items-center gap-4 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                        <span class="text-xl font-semibold text-gray-900">{{ $car->gasoline->type }}</span>
                    </div>

                    <!-- Car Description Section -->
                    <div class="p-6 rounded-lg flex md:flex-row flex-col items-center gap-4 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                        <span class="text-lg text-gray-900 font-medium">{{ $car->description }}</span>
                    </div>

            </div>

            <!-- Main Image Display Section -->
            <div class="flex flex-col items-center justify-center w-full">
                <div id="imageCarousel" class="relative w-auto h-auto">
                    <div class="h-auto w-auto flex flex-col items-center justify-center">
                        @foreach ($car->images as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="صورة السيارة" class="w-auto h-auto object-cover rounded-lg shadow-lg transition-all duration-300 ease-in-out mb-4">
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Contact Seller Buttons -->
            <div class="p-8 flex md:flex-row flex-col justify-start gap-6 md:max-w-full max-w-[65%] mt-8 ">
                <button class="bg-gradient-to-r from-gray-600 via-gray-700 to-gray-800 text-white px-8 py-4 rounded-lg hover:bg-gradient-to-l from-gray-500 via-gray-600 to-gray-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg flex items-center gap-3 whitespace-nowrap justify-center" onclick="openContactModal()">
                    <i class="fas fa-user"></i>
                    اتصل بالبائع
                </button>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12 my-10">
        <div class="flex flex-row items-center justify-between w-full gap-4 overflow-x-auto overflow-y-hidden">
            <div class="flex flex-row items-center gap-4 text-gray-400">
                <i class="fas fa-user"></i>
                <h2>
                    مراسلة
                </h2>
            </div>

            <div class="flex flex-row items-center gap-4 text-gray-400">
                <i class="fas fa-heart"></i>
                <h2>
                    تفضيل
                </h2>
            </div>

            <div class="flex flex-row items-center gap-4 text-gray-400">
                <i class="fas fa-share"></i>
                <h2>
                    مشاركة
                </h2>
            </div>

            <div class="flex flex-row items-center gap-4 text-gray-400">
                <i class="fas fa-flag"></i>
                <h2>
                    بلاغ
                </h2>
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
