<?php

namespace App\Http\Requests\Admin\Image;

use App\Http\Requests\Admin\AdminRequest;

class UpdateImageRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'alt' => ['string', 'required'],
            'title' => ['string', 'nullable'],
        ];
    }
}
