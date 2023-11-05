<?php

namespace App\Http\Requests\Admin\ObjectImage;

use App\Http\Requests\Admin\AdminRequest;

class StoreObjectImageRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['required', 'image'],
        ];
    }
}
