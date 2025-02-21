<?php

namespace App\Services\Services;

use App\Models\User;
use App\Services\Constructors\PaymentConstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentService implements PaymentConstructor
{
    public function activate(User $user)
    {
        $selectedPlan = $user->plan;
        return view('moyassar.packs', compact('selectedPlan'));
    }

    public function processPayment(Request $request)
    {
        $plan = $request->input('plan');
        $user = Auth::user();

        $expDate = $request->input('exp_date');
        list($expMonth, $expYear) = explode('/', $expDate);

        try {
            // Step 1: Tokenize the card
            $tokenResponse = Http::withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . env('TAP_SECRET_KEY'),
            ])->post('https://api.tap.company/v2/tokens', [
                'card' => [
                    'number' => $request->input('card_number'),
                    'exp_month' => $expMonth,
                    'exp_year' => $expYear,
                    'cvc' => $request->input('cvc'),
                    'name' => $request->input('card_name'),
                ],
                'client_ip' => $request->ip(),
            ]);

            if (!$tokenResponse->successful()) {
                $errorMessage = $tokenResponse->json()['message'] ?? 'فشلت عملية إنشاء التوكن.';
                Log::error('Tap Tokenization Error:', ['error' => $errorMessage]);
                return response()->json(['success' => false, 'error' => $errorMessage], 400);
            }

            $tokenData = $tokenResponse->json();
            $tokenId = $tokenData['id'];

            // Step 2: Create a charge using the token
            $chargeResponse = Http::withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . env('TAP_SECRET_KEY'),
            ])->post('https://api.tap.company/v2/charges', [
                'amount' => $plan === 'semi_annual' ? 34500 : 57500, // Amount in halalas
                'currency' => 'SAR',
                'threeDSecure' => true,
                'description' => 'Subscription Payment',
                'statement_descriptor' => 'Moyassar Subscription',
                'metadata' => [
                    'plan' => $plan,
                    'user_id' => $user->id,
                ],
                'reference' => [
                    'transaction' => 'txn_' . time(),
                    'order' => 'ord_' . time(),
                ],
                'receipt' => [
                    'email' => $user->email,
                    'sms' => true,
                ],
                'customer' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
                'source' => [
                    'id' => $tokenId,
                ],
                'redirect' => [
                    'url' => route('payment.redirect'), // Redirect URL after 3D Secure
                ],
            ]);

            if (!$chargeResponse->successful()) {
                $errorMessage = $chargeResponse->json()['message'] ?? 'فشلت عملية الدفع.';
                Log::error('Tap Charge Error:', ['error' => $errorMessage]);
                return response()->json(['success' => false, 'error' => $errorMessage], 400);
            }

            $chargeData = $chargeResponse->json();

            // Step 3: Handle 3D Secure Redirect or Direct Payment
            if (isset($chargeData['transaction']['url'])) {
                // 3D Secure Redirect
                return response()->json([
                    'success' => true,
                    'redirect_url' => $chargeData['transaction']['url'],
                ]);
            } else {
                // Direct Payment
                $user->plan = $plan;
                $user->save();

                return response()->json(['success' => true, 'message' => 'تمت معالجة الدفع بنجاح وتم تحديث خطتك.']);
            }
        } catch (\Exception $e) {
            Log::error('Payment Processing Error:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => 'حدث خطأ أثناء معالجة الدفع.'], 500);
        }
    }
}
