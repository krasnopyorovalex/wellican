<?php

namespace App\Http\Requests\Admin\ObjectType;

use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Support\Str;

/**
 * @property string $name
 * @property string $description
 * @property string alias
 */
class StoreObjectTypeRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'alias' => ['required', 'max:255', 'string', 'unique:object_types'],
            'description' => ['string'],
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
        ]);
    }
}
