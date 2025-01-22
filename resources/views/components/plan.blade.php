@if (!Auth::check())
    <p></p>
@else
    <div class="flex items-center justify-center gap-4 text-green-600 p-4 rounded-lg shadow-lg bg-white max-w-xs sm:max-w-md md:max-w-lg w-full my-10">
        <i class="fas fa-gift text-2xl animate-bounce mr-2 text-green-500"></i>
        <span class="font-semibold text-xl text-center text-gray-800">
            @php
                switch (Auth::user()->plan) {
                    case 'free':
                        $plan_name = "الخطة المجانية";
                        $plan_description = "إعلانين يوميًا بحد أقصى 7 إعلانات في الأسبوع.";
                        break;
                    case 'semi_annual':
                        $plan_name = "الخطة التجريبية نصف السنوية";
                        $plan_description = "عدد لا محدود من الإعلانات. نلتزم بعدم تغيير سعر الاشتراك طوال المدة.";
                        break;
                    case 'annual':
                        $plan_name = "الخطة التجريبية السنوية";
                        $plan_description = "عدد لا محدود من الإعلانات. نلتزم بعدم تغيير سعر الاشتراك طوال المدة.";
                        break;
                    default:
                        $plan_name = "غير محدد";
                        $plan_description = "لا توجد خطة محددة.";
                        break;
                }
            @endphp
            <div>
                <p class="text-xl">{{ $plan_name }}</p>
                <p class="text-sm text-gray-500">{{ $plan_description }}</p>
            </div>
        </span>
    </div>
@endif
