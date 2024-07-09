<?php

declare(strict_types=1);

namespace Domain\Entities\ObjectType;

use Database\Factories\ObjectTypeFactory;
use Domain\Entities\Filter\Filter;
use Domain\Entities\Image\Image;
use Domain\Entities\Object\Objects;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property int $id
 */
final class ObjectType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [''];

    protected static function newFactory(): Factory
    {
        return ObjectTypeFactory::new();
    }

    public function objects(): HasMany
    {
        return $this->hasMany(Objects::class, 'type_id');
    }

    public function filters(): HasMany
    {
        return $this->hasMany(Filter::class, 'parent_id');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')
            ->withUrl(get_class($this));
    }
}
