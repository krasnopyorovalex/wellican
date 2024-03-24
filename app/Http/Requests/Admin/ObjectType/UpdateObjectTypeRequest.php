<?php

namespace App\Http\Requests\Admin\ObjectType;

use Illuminate\Validation\Rule;

/**
 * @property int $id
 */
class UpdateObjectTypeRequest extends StoreObjectTypeRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'alias' => ['required', 'max:255', 'string', Rule::unique('object_types', 'alias')->ignore($this->alias, 'alias')],
        ]);
    }
}
