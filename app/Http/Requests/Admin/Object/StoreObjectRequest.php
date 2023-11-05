<?php

namespace App\Http\Requests\Admin\Object;

use App\Http\Requests\Admin\AdminRequest;
use Domain\Entities\Object\Enums\IsPremium;
use Domain\Entities\Object\Enums\TypePurchase;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * @property string $name
 * @property string $description
 * @property string $is_premium
 */
class StoreObjectRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'alias' => ['required', 'max:255', 'string', 'unique:objects'],
            'articul' => ['required', 'max:32', 'string', 'unique:objects'],
            'price' => ['required', 'numeric', 'gte:0', 'lte:4294967295'],
            'square' => ['required', 'regex:/^\d{1,8}(\.\d{1})?$/'],
            'type_purchase' => ['required', Rule::enum(TypePurchase::class)],
            'latitude' => ['required', 'regex:/^(\+|-)?(?:90(?:(?:\.0{6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{6})?))$/'],
            'longitude' => ['required', 'regex:/^(\+|-)?(?:180(?:(?:\.0{6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{6})?))$/'],
            'type_id' => ['required', 'numeric', 'exists:object_types,id'],
            'location_id' => ['required', 'numeric', 'exists:locations,id'],
            'description' => ['string'],
            'address' => ['required', 'string'],
            'is_premium' => ['required', Rule::enum(IsPremium::class)],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'alias' => Str::slug($this->name),
            'description' => strlen($this->description) ? $this->description : '',
            'is_premium' => strlen($this->is_premium) ? IsPremium::Yes->value : IsPremium::Not->value,
        ]);
    }

    public function messages(): array
    {
        return [
            'latitude.regex' => 'Поле Широта имеет ошибочный формат.',
            'longitude.regex' => 'Поле Долгота имеет ошибочный формат.',
            'square.regex' => 'Поле Площадь имеет ошибочный формат.',
        ];
    }
}
