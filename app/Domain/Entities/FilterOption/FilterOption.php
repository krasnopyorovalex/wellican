<?php

namespace Domain\Entities\FilterOption;

use Domain\Entities\Filter\Filter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Filter $filter
 */
final class FilterOption extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [''];

    protected $with = ['filter'];

    public function filter(): BelongsTo
    {
        return $this->belongsTo(Filter::class);
    }
}
