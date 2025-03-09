<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'image' => $this->isMethod('POST')
                ? ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
                : ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('Lütfen bir kategori adı giriniz.'),
            'name.string' => __('Kategori adı yalnızca metin içermelidir.'),
            'name.max' => __('Kategori adı en fazla :max karakter olabilir.'),
            'image.required' => __('Lütfen bir resim yükleyiniz.'),
            'image.image' => __('Yüklediğiniz dosya bir resim olmalıdır.'),
            'image.mimes' => __('Resim formatı geçersiz. Yalnızca :values uzantılı dosyalar yükleyebilirsiniz.'),
            'image.max' => __('Resim boyutu en fazla :max KB olabilir.'),
        ];
    }
}
