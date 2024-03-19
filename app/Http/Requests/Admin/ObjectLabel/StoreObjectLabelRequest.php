<?php

namespace App\Http\Requests\Admin\ObjectLabel;

use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * @property string $name
 */
class StoreObjectLabelRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:64', 'string'],
        ];
    }
}
