<x-app-layout>
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.14.0/moyasar.css" />

    <div class="flex justify-center items-center min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-6 space-y-6">
            <h2 class="text-center text-2xl font-semibold text-gray-800">دفع الفاتورة</h2>

            <form id="payment-form" class="space-y-4">
                <!-- مكان الحقول الخاصة ببطاقة الائتمان -->
                <div class="mysr-form bg-gray-100 rounded-lg p-4"></div>

                <input type="hidden" name="callback_url" value="{{ $callback_url }}">
                <input type="hidden" name="publishable_api_key" value="{{ $publishable_api_key }}">
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="source[type]" value="creditcard">

                <button type="submit" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200">
                    ادفع الآن
                </button>
            </form>
        </div>
    </div>

    <script>
        Moyasar.init({
            element: '.mysr-form',
            amount: {{ $amount }},
            currency: 'SAR',
            description: 'وصف الدفع',
            publishable_api_key: '{{ $publishable_api_key }}',
            callback_url: '{{ $callback_url }}',
            on_completed: function(payment) {
                console.log(payment);
            }
        });
    </script>
</x-app-layout>
