<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>خيارات الدفع</title>
</head>
<body>
    @include('components.header')

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex items-center justify-between mt-20" role="alert">
            <div>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex items-center justify-between mt-20" role="alert">
            <div>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            <div>
                <button type="button" class="text-red-500 hover:text-red-600 focus:outline-none" onclick="this.parentElement.parentElement.remove();">
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="container mx-auto p-4">
        <form action="{{ route('payment.process', ['plan' => $selectedPlan]) }}" method="POST" id="payment-form">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
                <!-- Free Plan -->
                <div class="bg-white border border-gray-300 rounded-xl shadow-lg p-6 hover:scale-105 hover:shadow-2xl transition-transform duration-300" id="free-plan">
                    <div class="flex justify-center mb-4">
                        <i class="fa-solid fa-gift text-4xl text-gray-500"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-600 text-center mb-4" id="free-plan-title">الخطة المجانية</h2>
                    <div class="text-center">
                        <p class="text-sm text-gray-500 mb-6" id="free-plan-description">
                            إعلانين يوميًا بحد أقصى 7 إعلانات في الأسبوع.
                        </p>
                    </div>
                    <button type="button" class="w-full bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-bold" onclick="selectPlan('free')">اختيار هذه الخطة</button>
                </div>

                <!-- Semi-Annual Trial Plan -->
                <div class="bg-white border border-gray-300 rounded-xl shadow-lg p-6 relative hover:scale-105 hover:shadow-2xl transition-transform duration-300" id="semi-annual-plan">
                    <div class="absolute top-0 right-0 bg-orange-500 text-white text-sm px-3 py-1 rounded-bl-lg" id="semi-annual-plan-label">الأكثر اختيارًا</div>
                    <div class="flex justify-center mb-4">
                        <i class="fa-solid fa-star text-4xl text-yellow-500"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-600 text-center mb-4" id="semi-annual-plan-title">الخطة التجريبية نصف السنوية</h2>
                    <div class="text-center">
                        <p class="text-4xl font-extrabold text-gray-800 mb-2" id="semi-annual-plan-price">345 <span class="text-lg font-medium">ريال سعودي</span></p>
                        <p class="text-sm text-gray-500 mb-6" id="semi-annual-plan-description">
                            عدد لا محدود من الإعلانات. <br>
                            نلتزم بعدم تغيير سعر الاشتراك طوال المدة.
                        </p>
                    </div>
                    <button type="button" class="w-full bg-gray-100 text-black px-4 py-2 rounded-lg font-bold hover:bg-gray-200 transition-colors duration-300" onclick="selectPlan('semi_annual')">اختيار هذه الخطة</button>
                </div>

                <!-- Annual Trial Plan -->
                <div class="bg-white border border-gray-300 rounded-xl shadow-lg p-6 hover:scale-105 hover:shadow-2xl transition-transform duration-300" id="annual-plan">
                    <div class="flex justify-center mb-4">
                        <i class="fa-solid fa-crown text-4xl text-gray-700"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-600 text-center mb-4" id="annual-plan-title">الخطة التجريبية السنوية</h2>
                    <div class="text-center">
                        <p class="text-4xl font-extrabold text-gray-800 mb-2" id="annual-plan-price">575 <span class="text-lg font-medium">ريال سعودي</span></p>
                        <p class="text-sm text-gray-500 mb-6" id="annual-plan-description">
                            عدد لا محدود من الإعلانات. <br>
                            نلتزم بعدم تغيير سعر الاشتراك طوال المدة.
                        </p>
                    </div>
                    <button type="button" class="w-full bg-gray-100 text-black px-4 py-2 rounded-lg font-bold hover:bg-gray-200 transition-colors duration-300" onclick="selectPlan('annual')">اختيار هذه الخطة</button>
                </div>
            </div>

            <!-- Visa Card Information Form (Initially Hidden) -->
            <div id="visa-info-form" class="mt-8 hidden">
                <h2 class="text-xl font-bold text-gray-600 mb-4">معلومات بطاقة الفيزا - <span id="selected-plan-name"></span></h2>

                <!-- Card Number -->
                <div class="mb-4">
                    <label for="card_number" class="block text-sm font-semibold text-gray-700">رقم البطاقة</label>
                    <input type="text" name="card_number" id="card_number" class="w-full p-3 mt-2 border rounded-lg" required placeholder="XXXX XXXX XXXX XXXX">
                </div>

                <!-- Expiry Date -->
                <div class="mb-4">
                    <label for="exp_date" class="block text-sm font-semibold text-gray-700">تاريخ الإنتهاء</label>
                    <input type="text" name="exp_date" id="exp_date" class="w-full p-3 mt-2 border rounded-lg" required placeholder="MM/YY">
                </div>

                <!-- CVC -->
                <div class="mb-4">
                    <label for="cvc" class="block text-sm font-semibold text-gray-700">رمز الأمان (CVC)</label>
                    <input type="text" name="cvc" id="cvc" class="w-full p-3 mt-2 border rounded-lg" required placeholder="XXX">
                </div>

                <!-- Cardholder Name -->
                <div class="mb-4">
                    <label for="card_name" class="block text-sm font-semibold text-gray-700">اسم حامل البطاقة</label>
                    <input type="text" name="card_name" id="card_name" class="w-full p-3 mt-2 border rounded-lg" required placeholder="الاسم كما يظهر على البطاقة">
                </div>

                <div class="mt-8 text-center">
                    <button type="submit" class="w-full bg-blue-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-600 transition-colors duration-300">أكمل الدفع</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function selectPlan(plan) {
            let planName = '';
            if (plan === 'free') {
                planName = 'الخطة المجانية';
            } else if (plan === 'semi_annual') {
                planName = 'الخطة التجريبية نصف السنوية';
            } else if (plan === 'annual') {
                planName = 'الخطة التجريبية السنوية';
            }

            document.getElementById('selected-plan-name').innerText = planName;
            document.getElementById('visa-info-form').classList.remove('hidden');
        }

        document.getElementById('payment-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            const [exp_month, exp_year] = data.exp_date.split('/');
            data.exp_month = exp_month;
            data.exp_year = exp_year;

            try {
                const response = await fetch('{{ route('payment.process') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                console.log('API Response:', result);

                if (response.ok) {
                    if (result.redirect_url) {

                        window.location.href = result.redirect_url;
                    } else {
                        alert('تمت عملية الدفع بنجاح!');
                        window.location.href = '/';
                    }
                } else {
                    alert('فشل في عملية الدفع: ' + (result.error || 'الرجاء التحقق من البيانات المدخلة.'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('حدث خطأ أثناء معالجة الدفع. الرجاء المحاولة مرة أخرى.');
            }
        });
    </script>

</body>
</html>
