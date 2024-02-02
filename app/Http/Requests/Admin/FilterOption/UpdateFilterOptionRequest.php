<?php

namespace App\Http\Requests\Admin\FilterOption;

use App\Http\Requests\Admin\AdminRequest;

class UpdateFilterOptionRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:128', 'string'],
        ];
    }
}
