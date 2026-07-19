<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $subMenuId = $this->route('subMenu')?->id;

        return [
            'wmnu_id'   => ['required', 'integer', 'exists:tm_wmnu,id'],
            'wsmn_name' => ['required', 'string', 'max:30'],
            'wsmn_wurl' => ['required', 'string', 'max:100'],
            'wsmn_oseq' => ['required', 'integer', 'min:0'],
            'wsmn_ukey' => [
                'required', 'string', 'max:255',
                Rule::unique('tm_wsmn', 'wsmn_ukey')->ignore($subMenuId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'wmnu_id.required'   => 'প্যারেন্ট মেনু নির্বাচন করুন।',
            'wsmn_name.required' => 'সাব-মেনুর নাম আবশ্যক।',
            'wsmn_wurl.required' => 'URL আবশ্যক (যেমন: /admin/dashboard)।',
            'wsmn_ukey.required' => 'পারমিশন কী (unique key) আবশ্যক (যেমন: dashboard.overview)।',
            'wsmn_ukey.unique'   => 'এই পারমিশন কী ইতিমধ্যে ব্যবহৃত হয়েছে।',
        ];
    }

}
