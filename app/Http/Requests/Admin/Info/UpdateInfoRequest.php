<?php

namespace App\Http\Requests\Admin\Info;

use Illuminate\Validation\Rule;

/**
 * @property int $id
 */
class UpdateInfoRequest extends StoreInfoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'alias' => ['required', 'max:255', 'string', Rule::unique('news')->ignore($this->id)],
        ]);
    }
}
