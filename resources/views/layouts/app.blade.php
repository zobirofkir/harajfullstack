<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>{{config('app.name')}}</title>
</head>

<body>

    @include('components.header')

    <main class="md:px-10 px-4">
        {{ $slot }}
    </main>

    @include('components.footer')

    <script src="{{asset('assets/js/sidebare.js')}}"></script>
</body>
</html>
