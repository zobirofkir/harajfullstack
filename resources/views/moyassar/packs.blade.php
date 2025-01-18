<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>خيارات الدفع</title>
</head>
<body class="bg-gray-100 flex md:justify-center md:items-center h-screen">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-extrabold text-center mb-8 text-gray-800">اختر خطتك المثالية</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Monthly Plan -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <h2 class="text-xl font-bold text-indigo-600 text-center mb-4">الخطة الشهرية</h2>
                <div class="text-center">
                    <p class="text-4xl font-extrabold text-gray-800 mb-2">99 <span class="text-lg font-medium">ريال سعودي</span></p>
                    <p class="text-sm text-gray-600 mb-6">ادفع شهريًا وتمتع بمزايا مميزة.</p>
                </div>
                <ul class="mb-6 space-y-2 text-gray-600">
                    <li class="flex items-center"><i class="fa fa-check-circle text-indigo-500 mr-2"></i> دعم فني على مدار الساعة</li>
                    <li class="flex items-center"><i class="fa fa-check-circle text-indigo-500 mr-2"></i> مساحة تخزين غير محدودة</li>
                    <li class="flex items-center"><i class="fa fa-check-circle text-indigo-500 mr-2"></i> لوحة تحكم سهلة الاستخدام</li>
                </ul>
                <button class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-indigo-500 transition-colors duration-300">اشترك الآن</button>
            </div>

            <!-- Semi-Annual Plan -->
            <div class="bg-white border-2 border-indigo-600 rounded-lg shadow-lg p-6 transform scale-105">
                <h2 class="text-xl font-bold text-indigo-600 text-center mb-4">الخطة نصف السنوية</h2>
                <div class="text-center">
                    <p class="text-4xl font-extrabold text-gray-800 mb-2">499 <span class="text-lg font-medium">ريال سعودي</span></p>
                    <p class="text-sm text-gray-600 mb-6">وفر أكثر عند الاشتراك نصف السنوي.</p>
                </div>
                <ul class="mb-6 space-y-2 text-gray-600">
                    <li class="flex items-center"><i class="fa fa-check-circle text-indigo-500 mr-2"></i> دعم فني على مدار الساعة</li>
                    <li class="flex items-center"><i class="fa fa-check-circle text-indigo-500 mr-2"></i> شهادة SSL مجانية</li>
                    <li class="flex items-center"><i class="fa fa-check-circle text-indigo-500 mr-2"></i> نطاق مجاني لمدة 6 أشهر</li>
                </ul>
                <button class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-indigo-500 transition-colors duration-300">اشترك الآن</button>
            </div>

            <!-- Annual Plan -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <h2 class="text-xl font-bold text-indigo-600 text-center mb-4">الخطة السنوية</h2>
                <div class="text-center">
                    <p class="text-4xl font-extrabold text-gray-800 mb-2">899 <span class="text-lg font-medium">ريال سعودي</span></p>
                    <p class="text-sm text-gray-600 mb-6">الخيار الأفضل مع مزايا حصرية.</p>
                </div>
                <ul class="mb-6 space-y-2 text-gray-600">
                    <li class="flex items-center"><i class="fa fa-check-circle text-indigo-500 mr-2"></i> دعم فني على مدار الساعة</li>
                    <li class="flex items-center"><i class="fa fa-check-circle text-indigo-500 mr-2"></i> شهادة SSL مجانية</li>
                    <li class="flex items-center"><i class="fa fa-check-circle text-indigo-500 mr-2"></i> نطاق مجاني لمدة عام</li>
                </ul>
                <button class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-indigo-500 transition-colors duration-300">اشترك الآن</button>
            </div>
        </div>
    </div>

</body>
</html>
