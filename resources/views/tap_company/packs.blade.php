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
<body class="bg-gray-100">
    @include('components.header')

    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10 max-w-6xl mx-auto">
            @foreach([
                ['الخطة المجانية', '0 ريال سعودي', 'free', [
                    'عدد محدود من الإعلانات (3)',
                    'بدون شارة توثيق',
                    'عرض محدود للإعلان'
                ]],
                ['الخطة الأساسية', '345 ريال سعودي', 'basic', [
                    'عدد لا محدود من الإعلانات',
                    'شارة توثيق الحساب',
                    'عرض مميز للإعلان',
                    'دعم فني على مدار الساعة'
                ]],
                ['الخطة المميزة', '575 ريال سعودي', 'pro', [
                    'كل مميزات الخطة الأساسية',
                    'إعلانات مميزة في الصفحة الرئيسية',
                    'أولوية في نتائج البحث',
                    'تقارير تحليلية شهرية',
                    'استقبال طلبات التواصل'
                ]]
            ] as $plan)
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center relative overflow-hidden flex flex-col justify-between min-h-[500px]
                    @if($plan[2] === 'pro')
                        transform scale-105 border-2 border-blue-500 shadow-2xl bg-gradient-to-b from-white to-blue-50
                    @else
                        hover:transform hover:scale-102 hover:shadow-xl
                    @endif
                    transition-all duration-300 ease-in-out
                    @if(Auth::user()->plan === $plan[2] || (Auth::user()->plan !== 'free' && $plan[2] === 'free'))
                        opacity-50 cursor-not-allowed
                    @endif"
                    onclick="@if(Auth::user()->plan !== $plan[2] && !(Auth::user()->plan !== 'free' && $plan[2] === 'free')) selectPlan('{{ $plan[2] }}') @endif">

                    @if($plan[2] === 'pro')
                        <div class="absolute -top-4 -right-12 bg-blue-500 text-white px-12 py-1 transform rotate-45">الأكثر شعبية</div>
                    @endif

                    <!-- Plan Icon -->
                    <div class="text-5xl mb-6 @if($plan[2] === 'pro') text-blue-500 @else text-gray-800 @endif">
                        @if($plan[2] === 'free')
                            <i class="fas fa-user"></i>
                        @elseif($plan[2] === 'basic')
                            <i class="fas fa-star-half-alt"></i>
                        @elseif($plan[2] === 'pro')
                            <i class="fas fa-crown animate-pulse"></i>
                        @endif
                    </div>

                    <h2 class="text-2xl font-bold @if($plan[2] === 'pro') text-blue-600 @else text-gray-800 @endif mb-4">
                        {{ $plan[0] }}
                    </h2>

                    <div class="text-3xl font-bold @if($plan[2] === 'pro') text-blue-600 @else text-gray-800 @endif mb-6">
                        {{ $plan[1] }}
                        @if($plan[2] !== 'free')
                            <div class="text-sm text-gray-500 mt-1">سنوياً</div>
                        @endif
                    </div>

                    <div class="flex-grow">
                        <ul class="text-sm space-y-4">
                            @foreach($plan[3] as $feature)
                                <li class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5 @if($plan[2] === 'pro') text-blue-500 @else text-green-500 @endif" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                    </svg>
                                    <span class="@if($plan[2] === 'pro') text-gray-700 @else text-gray-600 @endif">
                                        {{ $feature }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <button class="mt-6 w-full px-6 py-4 rounded-full font-bold text-white transition-all duration-300
                        @if(Auth::user()->plan === $plan[2])
                            bg-gray-400 cursor-not-allowed
                        @else
                            @if($plan[2] === 'pro')
                                bg-blue-500 hover:bg-blue-600 hover:shadow-lg transform hover:-translate-y-1
                            @elseif($plan[2] === 'basic')
                                bg-green-500 hover:bg-green-600
                            @else
                                bg-gray-500 hover:bg-gray-600
                            @endif
                        @endif">
                        @if(Auth::user()->plan === $plan[2])
                            الخطة الحالية
                        @else
                            اختيار هذه الخطة
                        @endif
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <div id="success-alert" class="fixed top-5 right-5 p-4 bg-green-500 text-white font-bold rounded-lg shadow-lg opacity-0 transform translate-x-full transition-all duration-500">
        تمت عملية الدفع بنجاح!
    </div>
    <div id="error-alert" class="fixed top-5 right-5 p-4 bg-red-500 text-white font-bold rounded-lg shadow-lg opacity-0 transform translate-x-full transition-all duration-500"></div>

    <script>
        function selectPlan(plan) {
            fetch("{{ route('payment.process') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ plan: plan })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect_url;
                } else {
                    showAlert(document.getElementById('error-alert'), 'فشلت عملية الدفع: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert(document.getElementById('error-alert'), 'حدث خطأ أثناء عملية الدفع.');
            });
        }

        function showAlert(alertElement, message) {
            if (message) alertElement.innerText = message;
            alertElement.classList.remove('opacity-0', 'translate-x-full');
            alertElement.classList.add('opacity-100', 'translate-x-0');
            setTimeout(() => {
                alertElement.classList.remove('opacity-100', 'translate-x-0');
                alertElement.classList.add('opacity-0', 'translate-x-full');
            }, 3000);
        }
    </script>
</body>
</html>
