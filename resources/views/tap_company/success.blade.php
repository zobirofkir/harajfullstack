<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>خيارات الدفع</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen font-sans">
    <div class="success-container bg-white p-8 rounded-lg shadow-lg text-center max-w-md w-full mx-4">
        <div class="success-icon text-green-500 text-6xl mb-4">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="success-title text-2xl font-bold text-gray-800 mb-4">
            تمت عملية الدفع بنجاح!
        </div>
        <div class="success-message text-gray-600 mb-6">
            شكراً لك على دفعك. لقد تمت عملية الدفع بنجاح، وستصلك تفاصيل الإيصال على بريدك الإلكتروني.
        </div>
        <button
            class="success-button bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out"
            onclick="window.location.href='{{ route('home') }}'"
        >
            العودة إلى الصفحة الرئيسية
        </button>
    </div>
</body>
</html>
