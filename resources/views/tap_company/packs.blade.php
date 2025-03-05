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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            @foreach([['الخطة المجانية', '0 ريال سعودي', 'free'], ['الخطة نصف السنوية', '345 ريال سعودي', 'semi_annual'], ['الخطة السنوية', '575 ريال سعودي', 'annual']] as $plan)
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center relative overflow-hidden flex flex-col justify-between h-80 hover:transform hover:translate-y-2 hover:shadow-xl transition-all
                    @if(Auth::user()->plan === $plan[2] || (Auth::user()->plan !== 'free' && $plan[2] === 'free')) opacity-50 cursor-not-allowed @endif"
                     onclick="@if(Auth::user()->plan !== $plan[2] && !(Auth::user()->plan !== 'free' && $plan[2] === 'free')) selectPlan('{{ $plan[2] }}') @endif">

                    <!-- Plan Icon -->
                    <div class="text-4xl text-gray-800 mb-4">
                        @if($plan[2] === 'free')
                            <i class="fas fa-user"></i>
                        @elseif($plan[2] === 'semi_annual')
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="fas fa-star"></i>
                        @endif
                    </div>

                    <h2 class="text-lg font-bold text-gray-800 flex items-center justify-center gap-2">
                        @if($plan[2] === 'semi_annual' || $plan[2] === 'annual')
                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-3-3a1 1 0 111.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        @endif
                        {{ $plan[0] }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-2">عدد لا محدود من الإعلانات.</p>

                    <!-- Verification Badge Section -->
                    @if($plan[2] === 'semi_annual' || $plan[2] === 'annual')
                        <p class="text-sm text-gray-500 mt-1 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.758l1.071 2.143 2.143 1.071H17a1 1 0 011 1v2a1 1 0 01-1 1h-1.758l-2.143 1.071L11 15.242V17a1 1 0 01-1 1H9a1 1 0 01-1-1v-1.758l-1.071-2.143L4.786 12H3a1 1 0 01-1-1v-2a1 1 0 011-1h1.758l2.143-1.071L9 4.758V3a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            الحصول على شارة توثيق الحساب
                        </p>
                    @endif

                    <!-- Commitment Text -->
                    @if($plan[2] === 'semi_annual' || $plan[2] === 'annual')
                        <p class="text-sm text-gray-500 mt-1 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.758l1.071 2.143 2.143 1.071H17a1 1 0 011 1v2a1 1 0 01-1 1h-1.758l-2.143 1.071L11 15.242V17a1 1 0 01-1 1H9a1 1 0 01-1-1v-1.758l-1.071-2.143L4.786 12H3a1 1 0 01-1-1v-2a1 1 0 011-1h1.758l2.143-1.071L9 4.758V3a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            نلتزم بضمان وصولكم لكامل الفتره
                        </p>
                    @endif

                    <!-- Add new feature for annual plan only -->
                    @if($plan[2] === 'annual')
                        <p class="text-sm text-gray-500 mt-1 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.758l1.071 2.143 2.143 1.071H17a1 1 0 011 1v2a1 1 0 01-1 1h-1.758l-2.143 1.071L11 15.242V17a1 1 0 01-1 1H9a1 1 0 01-1-1v-1.758l-1.071-2.143L4.786 12H3a1 1 0 01-1-1v-2a1 1 0 011-1h1.758l2.143-1.071L9 4.758V3a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            استقبال طلبات التواصل من العملاء
                        </p>
                    @endif

                    <div class="text-2xl font-semibold text-gray-800 mt-3 {{ $plan[2] === 'free' ? 'text-gray-600' : '' }}">
                        {{ $plan[1] }}
                    </div>

                    <button class="bg-green-500 text-white font-bold py-2 px-5 rounded-full mt-5 w-full transition-colors
                        @if(Auth::user()->plan === $plan[2] || (Auth::user()->plan !== 'free' && $plan[2] === 'free')) bg-gray-400 cursor-not-allowed @else hover:bg-green-600 @endif">
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
