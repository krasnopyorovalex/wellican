<?php

namespace App\Http\Requests\Admin\Object;

use Illuminate\Validation\Rule;

/**
 * @property int $id
 */
class UpdateObjectRequest extends StoreObjectRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'alias' => ['required', 'max:255', 'string', Rule::unique('objects')->ignore($this->id)],
            'filters' => ['array', 'nullable'],
            'filters.*' => ['array', 'nullable'],
            'filters.*.*' => ['numeric', 'nullable'],
        ]);
    }
}
