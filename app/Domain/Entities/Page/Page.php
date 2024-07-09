<?php

namespace Domain\Entities\Page;

use Database\Factories\PageFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $template
 */
final class Page extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    protected static function newFactory(): Factory
    {
        return PageFactory::new();
    }
}
