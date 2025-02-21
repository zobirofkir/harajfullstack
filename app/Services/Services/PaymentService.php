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

        try {
            $response = Http::withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . env('TAP_SECRET_KEY'),
            ])->post('https://api.tap.company/v2/tokens', [
                'card' => [
                    'number' => $request->input('card_number'),
                    'exp_month' => $request->input('exp_month'),
                    'exp_year' => $request->input('exp_year'),
                    'cvc' => $request->input('cvc'),
                    'name' => $request->input('card_name'),
                    'address' => [
                        'country' => $request->input('country') ?? 'SA',
                        'line1' => $request->input('line1') ?? 'N/A',
                        'city' => $request->input('city') ?? 'N/A',
                        'street' => $request->input('street') ?? 'N/A',
                        'avenue' => $request->input('avenue') ?? 'N/A',
                    ],
                ],
                'client_ip' => $request->ip(),
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                Log::info('Tap Payment Response:', $responseData);

                $user->plan = $plan;
                $user->save();

                return response()->json(['success' => true, 'message' => 'تمت معالجة الدفع بنجاح وتم تحديث خطتك.']);
            } else {
                $errorMessage = $response->json()['message'] ?? 'فشلت عملية الدفع.';

                Log::error('Tap Payment Error:', ['error' => $errorMessage]);

                return response()->json(['success' => false, 'error' => $errorMessage], 400);
            }
        } catch (\Exception $e) {
            Log::error('Payment Processing Error:', ['error' => $e->getMessage()]);

            return response()->json(['success' => false, 'error' => 'حدث خطأ أثناء معالجة الدفع.'], 500);
        }
    }
}
