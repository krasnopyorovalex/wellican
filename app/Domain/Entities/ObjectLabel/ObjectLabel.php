<?php

namespace Domain\Entities\ObjectLabel;

use Database\Factories\ObjectLabelsFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
final class ObjectLabel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [''];

    protected static function newFactory(): Factory
    {
        return ObjectLabelsFactory::new();
    }
}
