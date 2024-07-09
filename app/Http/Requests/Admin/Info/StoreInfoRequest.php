<?php

namespace App\Http\Requests\Admin\Info;

use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Support\Str;

/**
 * @property string $name
 * @property string $body
 */
class StoreInfoRequest extends AdminRequest
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
            'alias' => ['required', 'max:255', 'string', 'unique:news'],
            'title' => ['required', 'max:255', 'string'],
            'description' => ['string', 'max:255', 'nullable'],
            'keywords' => ['string', 'max:255', 'nullable'],
            'body' => ['string'],
            'image' => ['image'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'alias' => Str::slug($this->name),
            'body' => strlen($this->body) ? $this->body : '',
        ]);
    }
}
