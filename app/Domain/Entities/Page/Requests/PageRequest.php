<?php

declare(strict_types=1);

namespace Domain\Entities\Page\Requests;

use Domain\Contracts\Http\Request;

final class PageRequest extends Request
{
    protected string $name;

    protected string $title;

    protected string $description;

    protected string $keywords;

    protected string $body;

    protected string $alias;

    protected string $template;

    public function toDatabase(): array
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'body' => $this->body,
            'alias' => $this->alias,
            'template' => $this->template,
        ];
    }
}
