<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ObjectTypes extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function objects(): HasMany
    {
        return $this->hasMany(Objects::class, 'type_id');
    }
}
