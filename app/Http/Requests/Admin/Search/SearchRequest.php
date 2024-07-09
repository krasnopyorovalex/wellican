<?php

namespace App\Http\Requests\Admin\Search;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['max:255', 'string', 'nullable'],
            'type_id' => ['int', 'nullable'],
            'location_id' => ['int', 'nullable'],
            'articul' => ['required', 'string', 'size:9'],
        ];
    }
}
