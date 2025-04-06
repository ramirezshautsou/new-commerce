<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'alias' => 'required|string|max:255|unique:products,alias,' . $this->route('product'),
            'description' => 'nullable|string|max:1000',
            'producer_id' => 'required|exists:producers,id',
            'production_date' => 'nullable|date|required_with:price',
            'price' => 'nullable|numeric|min:0|max:99999999.99',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'category_id.required' => __('messages.category_id_required', [
                'attribute' => __('field_names.category_id'),
            ]),
            'category_id.exists' => __('messages.category_id_exists', [
                'attribute' => __('field_names.category_id'),
            ]),

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

            'description.string' => __('messages.description_string', [
                'attribute' => __('field_names.description'),
            ]),
            'description.max' => __('messages.description_max', [
                'attribute' => __('field_names.description'),
            ]),

            'producer_id.required' => __('messages.producer_id_required', [
                'attribute' => __('field_names.producer_id'),
            ]),
            'producer_id.exists' => __('messages.producer_id_exists', [
                'attribute' => __('field_names.producer_id'),
            ]),

            'production_date.required_with' => __('messages.production_date_required_with_price', [
                'attribute' => __('field_names.production_date'),
            ]),
            'production_date.date' => __('messages.production_date', [
                'attribute' => __('field_names.production_date'),
            ]),

            'price.numeric' => __('messages.price_numeric', [
                'attribute' => __('field_names.price'),
            ]),
            'price.min' => __('messages.price_min', [
                'attribute' => __('field_names.price'),
            ]),
            'price.max' => __('messages.price_max', [
                'attribute' => __('field_names.price'),
            ]),
        ];
    }
}
