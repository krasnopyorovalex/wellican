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
            'price' => ['nullable', 'gt:0', 'max:4_294_967_295', 'numeric'],
            'type_purchase' => ['nullable', Rule::enum(TypePurchase::class)],
            'is_premium' => ['nullable', Rule::enum(IsPremium::class)],
            'type_id' => ['nullable', 'numeric', 'exists:object_types,id'],
            'location_id' => ['nullable', 'numeric', 'exists:locations,id'],
            'sort' => ['nullable', 'string', Rule::enum(Sort::class)],
            'filterOptions' => ['nullable', 'array'],
            'filterOptions.*' => ['nullable', 'numeric', 'exists:filters,id'],
            'filterOptions.*.*' => ['nullable', 'array'],
        ];
    }
}
