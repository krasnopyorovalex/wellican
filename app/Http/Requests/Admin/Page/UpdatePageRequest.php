<?php

namespace App\Http\Requests\Admin\Page;

use Illuminate\Validation\Rule;

/**
 * @property int $id
 */
class UpdatePageRequest extends StorePageRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'alias' => ['required', 'max:255', 'string', Rule::unique('pages')->ignore($this->id)],
        ]);
    }
}
