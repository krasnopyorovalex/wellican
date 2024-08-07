<?php

declare(strict_types=1);

namespace Domain\Entities\FilterOption\Requests;

use Domain\Contracts\Http\Request;

class FilterOptionRequest extends Request
{
    protected int $filterId;

    protected string $value;

    public function toDatabase(): array
    {
        return array_filter([
            'value' => $this->value,
            'filter_id' => $this->filterId ?? 0,
        ]);
    }

    public function toWhere(): array
    {
        return array_filter([
            'filter_id' => $this->filterId ?? 0,
            'id' => $this->id ?? 0,
        ]);
    }
}
