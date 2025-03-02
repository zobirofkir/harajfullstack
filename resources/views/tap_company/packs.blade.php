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
    <style>
        .custom-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            animation: slideIn 0.5s ease-out;
        }
        .custom-alert.success {
            background-color: #4CAF50;
        }
        .custom-alert.error {
            background-color: #F44336;
        }
        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    @include('components.header')

    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            @foreach([['الخطة المجانية', '0 ريال سعودي', 'free'], ['الخطة نصف السنوية', '345 ريال سعودي', 'semi_annual'], ['الخطة السنوية', '575 ريال سعودي', 'annual']] as $plan)
                <div class="bg-white border border-gray-300 rounded-xl shadow-lg p-6 hover:scale-105 transition-transform duration-300" onclick="selectPlan('{{ $plan[2] }}')">
                    <h2 class="text-xl font-bold text-gray-600 text-center">{{ $plan[0] }}</h2>
                    <p class="text-center text-gray-500 mt-2">عدد لا محدود من الإعلانات.</p>
                    <button class="w-full bg-{{ $loop->index === 0 ? 'gray-300 text-gray-700' : ($loop->index === 1 ? 'orange-500 text-white' : 'blue-500 text-white') }} px-4 py-2 rounded-lg font-bold mt-4">اختيار هذه الخطة</button>
                </div>
            @endforeach
        </div>
    </div>

    <div id="success-alert" class="custom-alert success">تمت عملية الدفع بنجاح!</div>
    <div id="error-alert" class="custom-alert error"></div>

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
                    window.location.href = data.redirect_url; // Redirect to Tap URL
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
            alertElement.style.display = 'block';
            setTimeout(() => {
                alertElement.style.display = 'none';
            }, 3000);
        }
    </script>
</body>
</html>
