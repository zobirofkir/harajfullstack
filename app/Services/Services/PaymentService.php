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
        return view('tap_company.packs', compact('selectedPlan'));
    }

    public function processPayment(Request $request)
    {
        $plan = $request->input('plan');
        $user = Auth::user();

        $expDate = $request->input('exp_date');
        list($expMonth, $expYear) = explode('/', $expDate);

        try {

            Log::info('TAP_SECRET_KEY:', ['key' => env('TAP_SECRET_KEY')]);
            Log::info('TAP_PUBLIC_KEY:', ['key' => env('TAP_PUBLIC_KEY')]);


            $chargeResponse = Http::withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . env('TAP_SECRET_KEY'),
            ])->post('https://api.tap.company/v2/charges', [
                'amount' => $plan === 'semi_annual' ? 34500 : 57500, // Amount in halalas
                'currency' => 'SAR',
                'threeDSecure' => true,
                'description' => 'Subscription Payment',
                'statement_descriptor' => 'Tap Subscription',
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
                    'object' => 'src_card',
                    'number' => $request->input('card_number'),
                    'exp_month' => $expMonth,
                    'exp_year' => $expYear,
                    'cvc' => $request->input('cvc'),
                    'name' => $request->input('card_name'),
                ],
                'redirect' => [
                    'url' => route('home'),
                ],
            ]);

            if (!$chargeResponse->successful()) {
                $errorMessage = $chargeResponse->json()['message'] ?? 'فشلت عملية الدفع.';
                Log::error('Tap Charge Error:', ['error' => $errorMessage, 'response' => $chargeResponse->json()]);
                return response()->json(['success' => false, 'error' => $errorMessage], 400);
            }

            $chargeData = $chargeResponse->json();


            if (isset($chargeData['transaction']['url'])) {

                return response()->json([
                    'success' => true,
                    'redirect_url' => $chargeData['transaction']['url'],
                ]);
            } else {

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
