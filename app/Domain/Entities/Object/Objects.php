<?php

declare(strict_types=1);

namespace Domain\Entities\Object;

use Database\Factories\ObjectsFactory;
use Domain\Entities\FilterOption\FilterOption;
use Domain\Entities\Location\Location;
use Domain\Entities\ObjectImage\ObjectImage;
use Domain\Entities\ObjectType\ObjectType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property ObjectType $type
 * @property array<ObjectImage> $images
 * @property array<FilterOption> $filterOptions
 */
final class Objects extends Model
{
    use HasFactory;

    protected $guarded = ['updated_at', 'created_at'];

    protected static function newFactory(): Factory
    {
        return ObjectsFactory::new();
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ObjectType::class, 'type_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ObjectImage::class, 'object_id')
            ->withUrls()
            ->orderBy('position');
    }

    public function filterOptions(): BelongsToMany
    {
        return $this->belongsToMany(FilterOption::class, 'object_filters', 'object_id', 'filter_option_id');
    }
}
