<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'email.required' => __(
                'messages.email_required', [
                'attribute' => __('field_names.email')
            ]),
            'email.email' => __(
                'messages.email_invalid', [
                'attribute' => __('field_names.email')
            ]),
            'email.unique' => __(
                'messages.email_unique', [
                'attribute' => __('field_names.email')
            ]),

            'password.required' => __(
                'messages.password_required', [
                'attribute' => __('field_names.password')
            ]),
            'password.min' => __(
                'messages.password_min', [
                'attribute' => __('field_names.password')
            ]),
            'password.confirmed' => __(
                'messages.password_confirmation', [
                'attribute' => __('field_names.password')
            ]),
        ];
    }
}
