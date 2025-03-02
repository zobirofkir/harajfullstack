<?php

namespace App\Services\Services;

use App\Models\User;
use App\Services\Constructors\PaymentConstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PaymentService implements PaymentConstructor
{
    public function activate(User $user)
    {
        $selectedPlan = $user->plan;
        return view('tap_company.packs', compact('selectedPlan'));
    }

    public function processPayment(Request $request)
    {
        $user = Auth::user();
        $plan = $request->input('plan');

        $validator = Validator::make($request->all(), [
            'plan' => 'required|in:free,semi_annual,annual',
        ]);

        if ($validator->fails()) {
            Log::error('Validation Error:', ['errors' => $validator->errors()]);
            return response()->json(['success' => false, 'error' => $validator->errors()->first()], 400);
        }

        try {
            $amount = $plan === 'semi_annual' ? 34500 : ($plan === 'annual' ? 57500 : 0);
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('TAP_SECRET_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.tap.company/v2/charges', [
                'amount' => $amount,
                'currency' => 'SAR',
                'threeDSecure' => true,
                'description' => 'اختبار الدفع عبر Tap',
                'statement_descriptor' => 'Test Payment',
                'metadata' => [
                    'plan' => $plan,
                    'user_id' => $user->id
                ],
                'reference' => [
                    'transaction' => 'txn_' . time(),
                    'order' => 'ord_' . time()
                ],
                'receipt' => [
                    'email' => $user->email,
                    'sms' => true
                ],
                'customer' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
                'source' => [
                    'id' => 'src_all' // Use 'src_all' to allow all payment methods
                ],
                'redirect' => [
                    'url' => route('payment.success') // Redirect to the success page
                ]
            ]);

            $data = $response->json();
            if (!$response->successful()) {
                Log::error('Payment API Error:', ['response' => $data]);
                return response()->json(['success' => false, 'error' => $data['errors'][0]['description'] ?? 'فشلت عملية الدفع.'], 400);
            }

            // Update the user's plan after successful payment
            $user->plan = $plan;
            $user->save();

            return response()->json([
                'success' => true,
                'redirect_url' => $data['transaction']['url'] ?? route('payment.success'),
            ]);
        } catch (\Exception $e) {
            Log::error('Payment Error:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => 'حدث خطأ أثناء الدفع.'], 500);
        }
    }
}
