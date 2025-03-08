<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="description" content="{{$description ?? 'أفضل العروض لبيع السيارات الجديدة والمستعملة.'}}">
    <meta name="keywords" content="{{$keywords ?? 'بيع سيارات, سيارات مستعملة, سيارات جديدة, شراء سيارة, بيع سيارة, عروض سيارات'}}">
    <meta name="author" content="{{config('app.name')}}">

    <meta property="og:title" content="{{$title}}">
    <meta property="og:description" content="{{$description ?? 'أفضل العروض لبيع السيارات الجديدة والمستعملة.'}}">
    <meta property="og:image" content="{{$ogImage ?? 'default-car-image-url.jpg'}}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{$title}}">
    <meta name="twitter:description" content="{{$description ?? 'أفضل العروض لبيع السيارات الجديدة والمستعملة.'}}">
    <meta name="twitter:image" content="{{$twitterImage ?? 'default-car-image-url.jpg'}}">

    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/pusher.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
    <title>{{$title}}</title>
</head>

<body class="animate-fade-in">

    @include('components.header')

    <main>
        {{ $slot }}
    </main>

    @include('components.footer')

    <script src="{{asset('assets/js/sidebare.js')}}"></script>
    <script src="{{asset('assets/js/cars.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    @stack('scripts')
</body>
</html>
