<?php

namespace Domain\Entities\Image;

use Domain\Persistence\Configs\FilePath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property int $imageable_id
 * @property string $imageable_type
 * @property string $alt
 * @property string $title
 * @property string $filename
 * @property string $ext
 * @property string $url
 *
 * @method withUrl(Builder $builder)
 */
final class Image extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [''];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeWithUrl(Builder $query, string $entityClass): void
    {
        $subDir = FilePath::createDir($entityClass);

        $query->selectRaw('
                id,
                imageable_id,
                imageable_type,
                title,
                alt,
                concat(\'/storage/\', \''.$subDir.'\', \'/\', filename, \'.\', ext) as url
            ');
    }
}
