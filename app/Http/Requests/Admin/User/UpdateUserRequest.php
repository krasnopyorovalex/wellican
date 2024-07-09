<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * @property int $id
 */
class UpdateUserRequest extends StoreUserRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'email' => ['required', 'max:255', 'string', Rule::unique('users')->ignore($this->id)],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);
    }
}
