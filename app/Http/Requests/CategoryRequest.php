<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'alias' => 'required|string|max:255|unique:categories,alias,'
                . ($this->route('category') ?? 'NULL'),
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

            'alias.required' => __('messages.alias_required', [
                'attribute' => __('field_names.alias'),
            ]),
            'alias.string' => __('messages.alias_string', [
                'attribute' => __('field_names.alias'),
            ]),
            'alias.max' => __('messages.alias_max', [
                'attribute' => __('field_names.alias'),
            ]),
            'alias.unique' => __('messages.alias_unique', [
                'attribute' => __('field_names.alias'),
            ]),
        ];
    }
}
