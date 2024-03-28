<?php

namespace App\Http\Requests\Admin\Object;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

/**
 * @property int $id
 */
class UpdateObjectRequest extends StoreObjectRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'alias' => ['required', 'max:255', 'string', Rule::unique('objects')->ignore($this->id)],
            'filters' => ['array', 'nullable'],
            'filters.*' => ['numeric', 'nullable'],
        ]);
    }
}
