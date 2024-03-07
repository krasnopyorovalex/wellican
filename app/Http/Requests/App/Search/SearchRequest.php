<?php

declare(strict_types=1);

namespace App\Http\Requests\App\Search;

use Domain\Entities\Object\Enums\IsPremium;
use Domain\Entities\Object\Enums\TypePurchase;
use Domain\Services\Search\Enums\Sort;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'max:128', 'string'],
            'price_from' => ['nullable', 'gt:0', 'max:4294967295', 'numeric'],
            'price_to' => ['nullable', 'gt:0', 'max:4294967295', 'numeric'],
            'square_from' => ['nullable', 'gt:0', 'max:999999999.9', 'numeric'],
            'square_to' => ['nullable', 'gt:0', 'max:999999999.9', 'numeric'],
            'type_purchase' => ['nullable', Rule::enum(TypePurchase::class)],
            'is_premium' => ['nullable', Rule::enum(IsPremium::class)],
            'type_id' => ['nullable', 'numeric', 'exists:object_types,id'],
            'location_id' => ['nullable', 'numeric', 'exists:locations,id'],
            'sort' => ['nullable', 'string', Rule::enum(Sort::class)],
            'options' => ['nullable', 'array'],
            'options.*' => ['nullable', 'array'],
            'between' => ['nullable', 'array'],
            'between.*' => ['nullable', 'array'],
        ];
    }
}
