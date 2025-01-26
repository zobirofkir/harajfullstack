<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactSellerRequest extends FormRequest
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
            'car_id' => 'required|exists:cars,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'car_id.required' => 'السيارة مطلوبة',
            'car_id.exists' => 'السيارة غير صحيحة',
            'name.required' => 'الاسم مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.email' => 'البريد الالكتروني يجب ان يكون انجليسي',
            'email.max' => 'البريد الالكتروني يجب ان يكون اكثر من 255 حرف',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.string' => 'رقم الهاتف يجب ان يكون نص',
            'phone.max' => 'رقم الهاتف يجب ان يكون اكثر من 255 حرف',
            'message.required' => 'الرسالة مطلوبة',
            'message.string' => 'الرسالة يجب ان يكون نص',
        ];
    }
}
