<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>خطأ في الدفع</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('components.header')

    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow-lg p-6 mt-10 text-center">
            <div class="text-red-500 text-5xl mb-4">
                <i class="fas fa-times-circle"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-4">فشلت عملية الدفع</h1>
            <p class="text-gray-600 mb-6">{{ session('error') ?? 'حدث خطأ أثناء معالجة الدفع. الرجاء المحاولة مرة أخرى.' }}</p>
            <a href="{{ route('home') }}" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition-colors">
                العودة إلى صفحة الدفع
            </a>
        </div>
    </div>
</body>
</html>
