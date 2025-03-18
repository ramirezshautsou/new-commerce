<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'alias' => 'required|string|max:255|unique:services,alias,' . $this->route('service'),
            'target_date' => 'nullable|date',
            'price' => 'nullable|numeric|min:0|max:99999999.99',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __(
                'messages.name_required', [
                'attribute' => __('field_names.name',
                )]),
            'name.string' => __(
                'messages.name_string', [
                'attribute' => __('field_names.name',
                )]),
            'name.max' => __(
                'messages.name_max', [
                'attribute' => __('field_names.name',
                )]),

            'alias.required' => __(
                'messages.alias_required', [
                'attribute' => __('field_names.alias',
                )]),
            'alias.string' => __(
                'messages.alias_string', [
                'attribute' => __('field_names.alias',
                )]),
            'alias.max' => __(
                'messages.alias_max', [
                'attribute' => __('field_names.alias',
                )]),
            'alias.unique' => __(
                'messages.alias_unique', [
                'attribute' => __('field_names.alias',
                )]),

            'target_date.date' => __(
                'messages.target_date', [
                'attribute' => __('field_names.target_date',
                )]),

            'price.numeric' => __(
                'messages.price_numeric', [
                'attribute' => __('field_names.price',
                )]),
            'price.min' => __(
                'messages.price_min', [
                'attribute' => __('field_names.price',
                )]),
        ];
    }
}
