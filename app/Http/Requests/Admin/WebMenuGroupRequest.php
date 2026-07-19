<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebMenuGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $groupId = $this->route('group')?->id;

        return [
            'wmng_name' => ['required', 'string', 'max:20'],
            'wmng_code' => [
                'required', 'string', 'max:10',
                Rule::unique('tm_wmng', 'wmng_code')->ignore($groupId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'wmng_name.required' => 'গ্রুপের নাম আবশ্যক।',
            'wmng_name.max'      => 'গ্রুপের নাম সর্বোচ্চ ২০ অক্ষরের হতে হবে।',
            'wmng_code.required' => 'গ্রুপ কোড আবশ্যক।',
            'wmng_code.max'      => 'গ্রুপ কোড সর্বোচ্চ ১০ অক্ষরের হতে হবে।',
            'wmng_code.unique'   => 'এই গ্রুপ কোড ইতিমধ্যে ব্যবহৃত হয়েছে।',
        ];
    }
}
