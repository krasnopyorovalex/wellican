<?php

namespace Domain\Entities\ObjectImage;

use Domain\Entities\Object\Objects;
use Domain\Entities\ObjectImage\Configs\ObjectImagePath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property int $object_id
 * @property string $directory
 * @property string $filename
 * @property string $ext
 * @property string $url
 * @property string $thumb
 *
 * @method withImageUrls(int $objectId)
 */
final class ObjectImage extends Model
{
    use HasFactory;

    protected $guarded = ['updated_at', 'created_at'];

    public function object(): BelongsTo
    {
        return $this->belongsTo(Objects::class);
    }

    public function scopeWithUrls(Builder $query): void
    {
        $subDir = DB::escape(ObjectImagePath::pathWithOutObject());

        $query->selectRaw('
                    id,
                    alt,
                    object_id,
                    filename,
                    ext,
                    title,
                    position,
                    concat(\'/storage/\', '.$subDir.', object_id, \'/\', filename, \'.\', ext) as url,
                    concat(\'/storage/\', '.$subDir.', object_id, \'/\', filename, \'_thumb.\', ext) as thumb
                ');
    }
}
