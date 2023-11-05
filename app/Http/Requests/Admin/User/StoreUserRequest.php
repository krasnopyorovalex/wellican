<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends AdminRequest
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
            'email' => ['required', 'max:255', 'string', Rule::unique('users')],
            'image' => ['image'],
            'role' => ['required', 'numeric', 'exists:roles,id'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ];
    }
}
