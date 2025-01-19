<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.14.0/moyasar.css" />
    <script src="https://cdnjs.cloudflare.com/polyfill/v3/polyfill.min.js?version=4.8.0&features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.14.0/moyasar.js"></script>
    <title>خيارات الدفع</title>
</head>
<body class="bg-gray-100 flex md:justify-center md:items-center h-screen">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-extrabold text-center mb-8 text-gray-800">اختر خطتك المثالية</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Free Plan -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <h2 class="text-xl font-bold text-indigo-600 text-center mb-4">الخطة المجانية</h2>
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-6">
                        إعلانين يوميًا بحد أقصى 7 إعلانات في الأسبوع.
                    </p>
                </div>
                <button class="w-full bg-gray-400 text-white px-4 py-2 rounded-lg font-bold cursor-not-allowed">مجاني</button>
            </div>

            <!-- Semi-Annual Trial Plan -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <h2 class="text-xl font-bold text-indigo-600 text-center mb-4">الخطة التجريبية نصف السنوية</h2>
                <div class="text-center">
                    <p class="text-4xl font-extrabold text-gray-800 mb-2">345 <span class="text-lg font-medium">ريال سعودي</span></p>
                    <p class="text-sm text-gray-600 mb-6">
                        عدد لا محدود من الإعلانات. <br>
                        نلتزم بعدم تغيير سعر الاشتراك طوال المدة.
                    </p>
                </div>
                <button
                    class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-indigo-500 transition-colors duration-300"
                    onclick="paySemiAnnual()"
                >
                    اشترك الآن
                </button>
                <div class="semi-annual-payment"></div>
            </div>

            <!-- Annual Trial Plan -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <h2 class="text-xl font-bold text-indigo-600 text-center mb-4">الخطة التجريبية السنوية</h2>
                <div class="text-center">
                    <p class="text-4xl font-extrabold text-gray-800 mb-2">575 <span class="text-lg font-medium">ريال سعودي</span></p>
                    <p class="text-sm text-gray-600 mb-6">
                        عدد لا محدود من الإعلانات. <br>
                        نلتزم بعدم تغيير سعر الاشتراك طوال المدة.
                    </p>
                </div>
                <button
                    class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-indigo-500 transition-colors duration-300"
                    onclick="payAnnual()"
                >
                    اشترك الآن
                </button>
                <div class="annual-payment"></div>
            </div>
        </div>
    </div>

    <script>
        function paySemiAnnual() {
            Moyasar.init({
                element: '.semi-annual-payment',
                amount: 34500, // المبلغ بالهللة
                currency: 'SAR',
                description: 'اشتراك الخطة التجريبية نصف السنوية',
                publishable_api_key: 'pk_test_bFXYGZg2Ue4yXHBQ8JkzCnv5oKEhuKnc3MiALy9c',
                callback_url: 'https://zobirofkir.com',
                methods: ['creditcard', 'applepay', 'stcpay'],
            });
        }

        function payAnnual() {
            Moyasar.init({
                element: '.annual-payment',
                amount: 57500, // المبلغ بالهللة
                currency: 'SAR',
                description: 'اشتراك الخطة التجريبية السنوية',
                publishable_api_key: 'pk_test_bFXYGZg2Ue4yXHBQ8JkzCnv5oKEhuKnc3MiALy9c',
                callback_url: 'https://zobirofkir.com',
                methods: ['creditcard', 'applepay', 'stcpay'],
            });
        }
    </script>

</body>
</html>
