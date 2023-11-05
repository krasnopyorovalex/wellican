<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objects extends Model
{
    use HasFactory, SoftDeletes;

    public function type(): BelongsTo
    {
        return $this->belongsTo(ObjectTypes::class, 'type_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Locations::class);
    }
}
