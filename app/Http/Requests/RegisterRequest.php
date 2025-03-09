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
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z0-9_]{3,30}$/', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'firstname.required' => __('Adınızı giriniz.'),
            'firstname.string' => __('Adınız geçerli bir metin olmalıdır.'),
            'firstname.max' => __('Adınız en fazla 50 karakter olmalıdır.'),
            'lastname.required' => __('Soyadınızı giriniz.'),
            'lastname.string' => __('Soyadınız geçerli bir metin olmalıdır.'),
            'lastname.max' => __('Soyadınız en fazla 50 karakter olmalıdır.'),
            'email.required' => __('E-posta adresinizi giriniz.'),
            'email.string' => __('E-posta adresi geçerli bir metin olmalıdır.'),
            'email.email' => __('Lütfen geçerli bir e-posta adresi girin.'),
            'email.max' => __('E-posta adresi en fazla 255 karakter olmalıdır.'),
            'email.unique' => __('Bu e-posta adresi zaten kayıtlı.'),
            'username.required' => __('Kullanıcı adınızı giriniz.'),
            'username.string' => __('Kullanıcı adınız geçerli bir metin olmalıdır.'),
            'username.max' => __('Kullanıcı adınız en fazla 50 karakter olmalıdır.'),
            'username.regex' => __('Kullanıcı adı yalnızca harfler, rakamlar ve alt çizgi (_) içerebilir.'),
            'username.unique' => __('Bu kullanıcı adı zaten alınmış.'),
            'password.required' => __('Şifrenizi giriniz.'),
            'password.string' => __('Şifreniz geçerli bir metin olmalıdır.'),
            'password.min' => __('Şifreniz en az 6 karakter olmalıdır.'),
            'password.confirmed' => __('Şifreleriniz eşleşmiyor.'),
        ];
    }
}
