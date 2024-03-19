<?php

namespace App\Http\Requests\Admin\ObjectType;

use App\Http\Requests\Admin\AdminRequest;

class SortableObjectTypeRequest extends AdminRequest
{
    public function rules(): array
    {
        return [
            'data' => ['required', 'array'],
            'data.*' => ['required', 'numeric', 'gt:0'],
        ];
    }
}
