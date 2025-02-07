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
                class="w-full mt-3 bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-semibold transition-all duration-300 disabled:bg-gray-400">
                إرسال الرمز
            </button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script defer>
        document.addEventListener("DOMContentLoaded", function () {
            const resendOtpBtn = document.getElementById("resendOtpBtn");

            // Get the stored data for attempts and the last attempt timestamp
            let attempts = parseInt(localStorage.getItem("otpAttempts") || 0);
            let lastAttemptTime = parseInt(localStorage.getItem("lastAttemptTime") || 0);

            const currentTime = Date.now();
            const oneHourInMilliseconds = 3600000;

            // Reset attempts if more than 1 hour has passed
            if (currentTime - lastAttemptTime > oneHourInMilliseconds) {
                attempts = 0;
                localStorage.setItem("otpAttempts", attempts);
            }

            function updateButtonState() {
                if (attempts >= 20) {
                    resendOtpBtn.disabled = true;
                    resendOtpBtn.innerText = "تم استنفاد المحاولات لهذا الساعة";
                    startCountdown();
                }
            }

            // Function to start a countdown timer for the resend button
            function startCountdown() {
                const countdownDuration = oneHourInMilliseconds - (currentTime - lastAttemptTime);
                const countdownInterval = setInterval(() => {
                    const remainingTime = countdownDuration - (Date.now() - lastAttemptTime);
                    if (remainingTime <= 0) {
                        clearInterval(countdownInterval);
                        resendOtpBtn.disabled = false;
                        resendOtpBtn.innerText = "إعادة إرسال الرمز";
                    } else {
                        const minutes = Math.floor(remainingTime / 60000);
                        const seconds = Math.floor((remainingTime % 60000) / 1000);
                        resendOtpBtn.innerText = `انتظر ${minutes}:${seconds < 10 ? '0' : ''}${seconds} دقيقة`;
                    }
                }, 1000);
            }

            updateButtonState();

            resendOtpBtn.addEventListener("click", function () {
                if (attempts < 3) {
                    // Increment the attempt count
                    attempts++;
                    localStorage.setItem("otpAttempts", attempts);

                    // Update the last attempt time
                    localStorage.setItem("lastAttemptTime", currentTime);

                    updateButtonState();

                    $.ajax({
                        url: "{{ route('resend.otp') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            alert("تم إرسال الرمز بنجاح!");
                        },
                        error: function(xhr, status, error) {
                            alert("حدث خطأ أثناء إرسال الرمز.");
                        }
                    });
                }
            });
        });
    </script>

</x-app-layout>
