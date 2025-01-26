<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'username' => 'required|string|max:255',
            'email' => 'required|email|exists:users,email',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'المستخدم مطلوب',
            'user_id.exists' => 'المستخدم غير صحيح',
            'car_id.required' => 'السيارة مطلوبة',
            'car_id.exists' => 'السيارة غير صحيحة',
            'username.required' => 'اسم المستخدم مطلوب',
            'username.string' => 'اسم المستخدم يجب ان يكون نص',
            'username.max' => 'اسم المستخدم يجب ان يكون اكثر من 255 حرف',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.email' => 'البريد الالكتروني يجب ان يكون انجليسي',
            'email.exists' => 'البريد الالكتروني غير صحيح',
        ];
}
