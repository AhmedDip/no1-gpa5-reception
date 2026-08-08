<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpazilaManagerAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'upazila_id' => ['required', 'integer', 'exists:upazilas,id'],
            'user_id'    => ['nullable', 'integer', 'exists:users,id'],
            'staff_id'   => ['nullable', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'upazila_id.required' => 'উপজেলা নির্বাচন করুন।',
            'upazila_id.exists'   => 'নির্বাচিত উপজেলাটি সঠিক নয়।',
            'user_id.exists'      => 'নির্বাচিত স্টাফ সঠিক নয়।',
            'staff_id.max'        => 'স্টাফ আইডি সর্বোচ্চ ২০ অক্ষরের হতে পারে।',
        ];
    }
}
