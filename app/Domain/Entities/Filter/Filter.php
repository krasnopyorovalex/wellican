<?php

namespace Domain\Entities\Filter;

use Domain\Entities\FilterOption\FilterOption;
use Domain\Entities\ObjectType\ObjectType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 */
final class Filter extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [''];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ObjectType::class, 'parent_id');
    }

    public function options(): HasMany
    {
        return $this->hasMany(FilterOption::class);
    }
}
