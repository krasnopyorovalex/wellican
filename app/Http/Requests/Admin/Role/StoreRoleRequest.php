<?php

namespace App\Http\Requests\Admin\Role;

use App\Http\Requests\Admin\AdminRequest;

class StoreRoleRequest extends AdminRequest
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
            'guard_name' => ['required', 'max:255', 'string'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['int'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'guard_name' => 'web',
        ]);
    }
}
