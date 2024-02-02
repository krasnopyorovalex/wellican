<?php

namespace App\Http\Requests\Admin\Page;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

/**
 * @property int $id
 */
class UpdatePageRequest extends StorePageRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'alias' => ['required', 'max:255', 'string', Rule::unique('pages')->ignore($this->id)],
        ]);
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'body' => strlen($this->body) ? $this->body : '',
        ]);
    }
}
