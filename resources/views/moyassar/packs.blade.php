<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.14.0/moyasar.css" />

    <!-- Moyasar Scripts -->
    <script src="https://cdnjs.cloudflare.com/polyfill/v3/polyfill.min.js?version=4.8.0&features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.14.0/moyasar.js"></script>

    <title>خيارات الدفع</title>
</head>
<body class="bg-white flex md:justify-center md:items-center h-screen">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-extrabold text-center mb-8 text-gray-800">اختر خطتك المثالية</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
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
                <button class="w-full bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-bold cursor-not-allowed" id="free-plan-button">مجاني</button>
            </div>

            <!-- Semi-Annual Trial Plan -->
            <div class="bg-white border border-gray-300 rounded-xl shadow-lg p-6 relative hover:scale-105 hover:shadow-2xl transition-transform duration-300" id="semi-annual-plan">
                <div class="absolute top-0 right-0 bg-blue-500 text-white text-sm px-3 py-1 rounded-bl-lg" id="semi-annual-plan-label">الأكثر اختيارًا</div>
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
                <button
                    class="w-full bg-gray-100 text-black px-4 py-2 rounded-lg font-bold hover:bg-gray-200 transition-colors duration-300 mysr-form"
                    data-amount="34500"
                    data-description="اشتراك الخطة التجريبية نصف السنوية"
                    data-plan="semi_annual"
                    id="semi-annual-plan-button"
                >
                    اشترك الآن
                </button>
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
                <button
                    class="w-full bg-gray-100 text-black px-4 py-2 rounded-lg font-bold hover:bg-gray-200 transition-colors duration-300 mysr-form"
                    data-amount="57500"
                    data-description="اشتراك الخطة التجريبية السنوية"
                    data-plan="annual"
                    id="annual-plan-button"
                >
                    اشترك الآن
                </button>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.mysr-form').forEach(function(button) {
            button.addEventListener('click', function() {
                const plan = button.getAttribute('data-plan');
                const amount = button.getAttribute('data-amount');
                const description = button.getAttribute('data-description');

                Moyasar.init({
                    element: button,
                    amount: amount,
                    currency: 'SAR',
                    description: description,
                    publishable_api_key: '{{ env('MOYASAR_API_KEY') }}',
                    callback_url: "{{ route('payment.callback') }}?plan=" + plan,
                    methods: ['creditcard', 'stcpay']
                });
            });
        });
    </script>

</body>
</html>
