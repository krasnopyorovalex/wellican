<?php

namespace Domain\Entities\Info;

use Domain\Entities\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property int $id
 * @property Image $image
 */
final class Info extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $guarded = ['created_at', 'updated_at'];

    protected $with = ['image'];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')
            ->withUrl(get_class($this));
    }
}
