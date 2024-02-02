<?php

namespace Domain\Entities\Location;

use Database\Factories\LocationFactory;
use Domain\Entities\Object\Objects;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Location extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [''];

    protected static function newFactory(): Factory
    {
        return LocationFactory::new();
    }

    public function objects(): HasMany
    {
        return $this->hasMany(Objects::class);
    }
}
