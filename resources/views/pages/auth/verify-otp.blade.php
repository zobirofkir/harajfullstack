<x-app-layout title="تحقق من الرمز">

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex items-center justify-between mt-20" role="alert">
            <div>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <form action="{{ route('verify.otp') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">

            <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center">تحقق من الرمز</h2>

            <label for="otp" class="block text-gray-600 mb-2">أدخل رمز التحقق:</label>
            <input type="text" name="otp" id="otp"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 text-center text-lg tracking-widest"
                required pattern="[0-9]{6}" title="يجب أن يكون الرمز مكونًا من 6 أرقام">

            <button type="submit"
                class="w-full mt-4 bg-gray-600 hover:bg-gray-700 text-white py-2 rounded-lg font-semibold transition-all duration-300">
                تحقق
            </button>

            <!-- زر إعادة إرسال OTP -->
            <button type="button" id="resendOtpBtn"
                class="w-full mt-3 bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-semibold transition-all duration-300 disabled:bg-gray-400"
                onclick="resendOtp()" disabled>
                إعادة إرسال الرمز <span id="countdown">10</span> ثانية
            </button>
        </form>
    </div>

    <!-- سكريبت لجعل زر إعادة الإرسال متاح بعد 10 ثانية -->
    <script>
        let countdownElement = document.getElementById('countdown');
        let resendButton = document.getElementById('resendOtpBtn');
        let timeLeft = 10;

        function startCountdown() {
            let interval = setInterval(() => {
                timeLeft--;
                countdownElement.innerText = timeLeft;
                if (timeLeft <= 0) {
                    clearInterval(interval);
                    resendButton.disabled = false;
                    resendButton.innerText = "إعادة إرسال الرمز";
                }
            }, 1000);
        }

        function resendOtp() {
            resendButton.disabled = true;
            resendButton.innerText = "جارٍ الإرسال...";

            fetch("{{ route('resend.otp') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ email: "{{ session('email') }}" })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("تم إرسال رمز جديد إلى بريدك الإلكتروني");
                    timeLeft = 10;
                    countdownElement.innerText = timeLeft;
                    startCountdown();
                } else {
                    alert("حدث خطأ، حاول مرة أخرى.");
                    resendButton.disabled = false;
                    resendButton.innerText = "إعادة إرسال الرمز";
                }
            })
            .catch(() => {
                alert("حدث خطأ أثناء إعادة إرسال الرمز");
                resendButton.disabled = false;
                resendButton.innerText = "إعادة إرسال الرمز";
            });
        }

        startCountdown();
    </script>
</x-app-layout>
