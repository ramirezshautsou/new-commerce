<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route('user'),
            'password' => $this->isCreating() ? 'required|string|min:8' : 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('messages.name_required', [
                'attribute' => __('field_names.name'),
            ]),
            'name.string' => __('messages.name_string', [
                'attribute' => __('field_names.name'),
            ]),
            'name.max' => __('messages.name_max', [
                'attribute' => __('field_names.name'),
            ]),

            'email.required' => __('messages.email_required', [
                'attribute' => __('field_names.email'),
            ]),
            'email.email' => __('messages.email_invalid', [
                'attribute' => __('field_names.email'),
            ]),
            'email.unique' => __('messages.email_unique', [
                'attribute' => __('field_names.email'),
            ]),

            'password.required' => __('messages.password_required', [
                'attribute' => __('field_names.password'),
            ]),
            'password.min' => __('messages.password_min', [
                'attribute' => __('field_names.password'),
            ]),

            'role_id.required' => __('messages.role_required', [
                'attribute' => __('field_names.role'),
            ]),
            'role_id.exists' => __('messages.role_exists', [
                'attribute' => __('field_names.role'),
            ]),
        ];
    }

    /**
     * @return bool
     */
    private function isCreating(): bool
    {
        return $this->isMethod('post');
    }
}
