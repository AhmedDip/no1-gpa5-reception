<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WebMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'wmnu_name' => ['required', 'string', 'max:30'],
            'wmnu_icon' => ['required', 'string', 'max:30'],
            'wmnu_oseq' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'wmnu_name.required' => 'মেনুর নাম আবশ্যক।',
            'wmnu_icon.required' => 'মেনু আইকন আবশ্যক (যেমন: bx bx-home)।',
            'wmnu_oseq.required' => 'মেনুর ক্রম আবশ্যক।',
        ];
    }


}
