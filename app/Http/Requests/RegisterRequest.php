<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|string|min:3|max:20|regex:/^[a-zA-Z0-9]+$/|unique:users,username',
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'account_type' => 'required|in:مستخدم,مشتري',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'اسم المستخدم مطلوب',
            'username.string' => 'اسم المستخدم يجب ان يكون نص',
            'username.min' => 'اسم المستخدم يجب ان يكون اكثر من 3 حروف',
            'username.regex' => 'اسم المستخدم يجب ان يكون اكتب من احرف وارقام',
            'username.unique' => 'اسم المستخدم موجود مسبقا',
            'name.required' => 'الاسم مطلوب',
            'name.max' => 'الاسم يجب ان يكون اكثر من 255 حرف',
            'name.unique' => 'الاسم موجود مسبقا',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.string' => 'البريد الالكتروني يجب ان يكون نص',
            'email.email' => 'البريد الالكتروني يجب ان يكون انجليسي',
            'email.max' => 'البريد الالكتروني يجب ان يكون اكثر من 255 حرف',
            'email.unique' => 'البريد الالكتروني موجود مسبقا',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.string' => 'كلمة المرور يجب ان يكون نص',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'image.image' => 'الصورة يجب ان تكون صورة',
            'image.mimes' => 'الصورة يجب ان يكون اكتب من jpeg,png,jpg,gif',
            'image.max' => 'الصورة يجب ان يكون اكثر من 2048 كيلوبايت',
            'account_type.required' => 'نوع الحساب مطلوب',
            'account_type.in' => 'نوع الحساب غير صحيح',
        ];
    }
}
