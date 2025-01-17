<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateMoyasarAccountController extends Controller
{
    public function createMoyasarAccount()
    {
        $client = new Client();

        try {
            $user = User::find(Auth::user()->id);

            if (!$user) {
                return response()->json([
                    'error' => 'User is not authenticated.'
                ], 401);
            }

            $response = $client->post('https://api.moyasar.com/v1/payments', [
                'form_params' => [
                    'amount' => 1000,
                    'currency' => 'SAR',
                    'payment_method' => 'mada',
                    'callback_url' => route('home'),
                    'user_id' => $user->id,
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . env('MOYASAR_API_KEY'),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            $moyasar_account_id = $data['id'];
            $user->moyasar_account_id = $moyasar_account_id;
            $user->save();

            return response()->json([
                'message' => 'تم إنشاء حساب Moyasar بنجاح.',
                'moyasar_account_id' => $moyasar_account_id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'حدث خطأ أثناء التواصل مع Moyasar.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
