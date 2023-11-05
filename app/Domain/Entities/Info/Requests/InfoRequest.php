<?php

declare(strict_types=1);

namespace Domain\Entities\Info\Requests;

use Domain\Contracts\Http\Request;

final class InfoRequest extends Request
{
    protected string $name;

    protected string $title;

    protected string $description;

    protected string $keywords;

    protected string $body;

    protected string $alias;

    public function toDatabase(): array
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'body' => $this->body,
            'alias' => $this->alias,
        ];
    }
}
