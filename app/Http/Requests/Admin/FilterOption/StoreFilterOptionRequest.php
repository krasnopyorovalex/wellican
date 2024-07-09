<?php

namespace App\Http\Requests\Admin\FilterOption;

use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class StoreFilterOptionRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'value' => ['required', 'max:128', 'string'],
        ];
    }
}
