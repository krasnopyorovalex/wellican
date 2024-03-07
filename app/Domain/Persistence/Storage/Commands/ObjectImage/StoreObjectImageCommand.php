<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Commands\ObjectImage;

use Domain\Contracts\Image\Resizer;
use Domain\Contracts\Image\Uploader;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Entities\Object\Objects;
use Domain\Entities\ObjectImage\Configs\ObjectImagePath;
use Domain\Entities\ObjectImage\ObjectImage;
use Domain\Entities\ObjectImage\Requests\ObjectImageRequest;
use Domain\Persistence\Storage\Resources\SingleRecourse;
use Domain\Services\ImageResizer\ValueObjects\ResizeConfig;
use Illuminate\Http\UploadedFile;

readonly class StoreObjectImageCommand implements Command
{
    public function __construct(
        private Uploader $uploader,
        private Resizer $resizer,
        private UploadedFile $uploadedFile,
        private Objects $object
    ) {
    }

    public function handle(): DatabaseResource
    {
        $builder = ObjectImage::query();

        $imageUpload = $this->uploader->upload($this->uploadedFile, ObjectImagePath::pathWithObject($this->object->id));

        $this->resizer->resize(
            new ResizeConfig($imageUpload, config('images.thumb.width'), config('images.thumb.height'))
        );

        $position = $builder->where('object_id', $this->object->id)->max('position') + 1;

        $request = ObjectImageRequest::fromArray(array_merge(
            (array) $imageUpload,
            [
                'object_id' => $this->object->id,
                'alt' => $this->object->name,
                'position' => $position,
            ]
        ));

        return new SingleRecourse($builder->create($request->toDatabase()));
    }
}
