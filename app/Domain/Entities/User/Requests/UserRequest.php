<?php

declare(strict_types=1);

namespace Domain\Entities\User\Requests;

use Domain\Contracts\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRequest extends Request
{
    protected string $name;

    protected string $email;

    protected string $password;

    public function toDatabase(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
    }
}
