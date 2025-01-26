<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'negotiable_offer_price' => 'required|numeric',
            'offer_email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'negotiable_offer_price.required' => 'السعر مطلوب',
            'negotiable_offer_price.numeric' => 'السعر يجب ان يكون رقم',
            'offer_email.required' => 'البريد الالكتروني مطلوب',
            'offer_email.email' => 'البريد الالكتروني يجب ان يكون انجليسي',
        ];
    }
}
