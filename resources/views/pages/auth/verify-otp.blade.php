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

            <!-- حقل إدخال OTP (مخفي افتراضيًا) -->
            <div id="otpContainer" class="hidden transition-opacity duration-500">
                <label for="otp" class="block text-gray-600 mb-2">أدخل رمز التحقق:</label>
                <input type="text" name="otp" id="otp"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 text-center text-lg tracking-widest"
                    required pattern="[0-9]{6}" title="يجب أن يكون الرمز مكونًا من 6 أرقام">

                <button type="submit"
                    class="w-full mt-4 bg-gray-600 hover:bg-gray-700 text-white py-2 rounded-lg font-semibold transition-all duration-300">
                    تحقق
                </button>

            </div>

            <!-- زر إعادة إرسال OTP -->
            <button type="button" id="resendOtpBtn"
                class="w-full mt-3 bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-semibold transition-all duration-300 disabled:bg-gray-400 flex items-center justify-center">
                <span id="btnText">إرسال الرمز</span>
                <svg id="loadingIcon" class="hidden ml-2 w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="white" stroke-width="4" stroke-dasharray="31.4 31.4" stroke-linecap="round"/>
                </svg>
            </button>
        </form>
    </div>

    <script defer>
        document.addEventListener("DOMContentLoaded", function () {
            const resendOtpBtn = document.getElementById("resendOtpBtn");
            const btnText = document.getElementById("btnText");
            const loadingIcon = document.getElementById("loadingIcon");
            const otpContainer = document.getElementById("otpContainer");

            let attempts = parseInt(localStorage.getItem("otpAttempts") || 0);
            let lastAttemptTime = parseInt(localStorage.getItem("lastAttemptTime") || 0);
            const currentTime = Date.now();
            const oneHour = 3600000;

            function updateButtonState() {
                if (currentTime - lastAttemptTime < oneHour && attempts >= 3) {
                    startCountdown(oneHour - (currentTime - lastAttemptTime));
                }
            }

            function startCountdown(duration) {
                let endTime = Date.now() + duration;
                const interval = setInterval(() => {
                    let remaining = Math.max(0, endTime - Date.now());
                    if (remaining === 0) {
                        clearInterval(interval);
                        resendOtpBtn.disabled = false;
                        btnText.innerText = "إعادة إرسال الرمز";
                        return;
                    }
                    let minutes = Math.floor(remaining / 60000);
                    let seconds = Math.floor((remaining % 60000) / 1000);
                    btnText.innerText = `انتظر ${minutes}:${seconds < 10 ? '0' : ''}${seconds} دقيقة`;
                }, 1000);
            }

            resendOtpBtn.addEventListener("click", function () {
                if (attempts < 3) {
                    attempts++;
                    localStorage.setItem("otpAttempts", attempts);
                    localStorage.setItem("lastAttemptTime", Date.now());

                    updateButtonState();

                    // تشغيل الأنيميشن
                    resendOtpBtn.disabled = true;
                    btnText.innerText = "جارٍ الإرسال...";
                    loadingIcon.classList.remove("hidden");

                    fetch("{{ route('resend.otp') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert("تم إرسال الرمز بنجاح!");

                        // إظهار حقل إدخال OTP مع تأثير Fade In
                        otpContainer.classList.remove("hidden");
                        otpContainer.classList.add("opacity-100");
                    })
                    .catch(error => {
                        alert("حدث خطأ أثناء إرسال الرمز.");
                    })
                    .finally(() => {
                        resendOtpBtn.disabled = false;
                        btnText.innerText = "إرسال الرمز";
                        loadingIcon.classList.add("hidden");
                    });
                }
            });
        });
    </script>

</x-app-layout>
