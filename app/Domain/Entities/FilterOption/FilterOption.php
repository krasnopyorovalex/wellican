<?php

namespace Domain\Entities\FilterOption;

use Domain\Entities\Filter\Filter;
use Domain\Entities\Object\ObjectFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Filter $filter
 */
final class FilterOption extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [''];

    public function filter(): BelongsTo
    {
        return $this->belongsTo(Filter::class);
    }

    public function objectFilters(): HasMany
    {
        return $this->hasMany(ObjectFilters::class, 'filter_option_id', 'id');
    }
}
