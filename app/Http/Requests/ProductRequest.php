<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric'],
            'image' => $this->isMethod('POST')
                ? ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
                : ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'categories' => ['required', 'array'],
            'categories.*' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('Ürün adı alanı gereklidir.'),
            'name.string' => __('Ürün adı bir metin olmalıdır.'),
            'name.max' => __('Ürün adı en fazla 50 karakter uzunluğunda olmalıdır.'),
            'price.required' => __('Fiyat alanı gereklidir.'),
            'price.numeric' => __('Fiyat bir sayı olmalıdır.'),
            'image.required' => __('Resim alanı gereklidir.'),
            'image.image' => __('Dosya bir resim olmalıdır.'),
            'image.mimes' => __('Resim, jpeg, png veya jpg formatında olmalıdır.'),
            'image.max' => __('Resim en fazla 2048 kilobayt boyutunda olmalıdır.'),
            'description.string' => __('Açıklama bir metin olmalıdır.'),
            'categories.required' => __('Ürün kategorisini seçiniz.'),
            'categories.array' => __('Ürün kategorisini seçiniz.'),
            'categories.*.required' => __('Ürün kategorisi seçiniz.'),
            'categories.*.numeric' => __('Geçerli bir ürün kategorisi seçiniz.'),
            'categories.*.exists' => __('Geçerli bir ürün kategorisi seçiniz.'),
        ];
    }
}
