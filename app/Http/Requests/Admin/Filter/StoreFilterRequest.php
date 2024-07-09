<?php

namespace App\Http\Requests\Admin\Filter;

use App\Domain\Entities\Filter\Enums\Template;
use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class StoreFilterRequest extends AdminRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:128', 'string'],
            'tpl' => Rule::enum(Template::class),
        ];
    }
}
