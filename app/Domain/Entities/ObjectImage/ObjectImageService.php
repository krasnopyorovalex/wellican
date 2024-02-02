<?php

declare(strict_types=1);

namespace Domain\Entities\ObjectImage;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Image\ImageResizer;
use Domain\Contracts\Image\ImageUploader;
use Domain\Contracts\Persistence\Handler;
use Domain\Contracts\Persistence\HasEntity;
use Domain\Entities\Object\Objects;
use Domain\Entities\ObjectImage\Commands\DestroyCommand;
use Domain\Entities\ObjectImage\Commands\StoreCommand;
use Domain\Entities\ObjectImage\Commands\UpdateCommand;
use Domain\Entities\ObjectImage\Configs\ObjectImagePath;
use Domain\Entities\ObjectImage\Queries\GetByIdQuery;
use Domain\Entities\ObjectImage\Requests\ObjectImageRequest;
use Domain\Persistence\Storage\ValueObjects\Message;
use Domain\Services\ImageResizer\ValueObjects\Config;
use Domain\Services\ImageUploader\DataTransferObjects\ImageUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

final class ObjectImageService
{
    public function __construct(
        private readonly Handler $commandHandler,
        private readonly ImageUploader $imageUploader,
        private readonly ImageResizer $imageResizer
    ) {
    }

    public function store(UploadedFile $uploadedFile, Objects $object): Message
    {
        $payload = new Message();

        try {
            $imageUpload = $this->imageUploader->upload($uploadedFile, ObjectImagePath::pathWithObject($object->id));

            $this->imageResizer->resize(
                new Config($imageUpload, config('images.thumb.width'), config('images.thumb.height'))
            );

            $request = ObjectImageRequest::fromArray(array_merge(
                (array) $imageUpload,
                ['objectId' => $object->id, 'alt' => $object->name]
            ));

            $this->commandHandler->execute(new StoreCommand($request));

            $payload->setMessage(__('actions.image.uploaded'));
        } catch (\Exception $exception) {
            $payload->setMessage($exception->getMessage());
        }

        return $payload;
    }

    public function getByRequest(Request $request): Model
    {
        /** @var HasEntity $query */
        $query = $this->commandHandler->execute(
            new GetByIdQuery($request)
        );

        return $query->getEntity();
    }

    public function update(Request $request): Message
    {
        $payload = new Message();

        try {
            $this->commandHandler->execute(new UpdateCommand($request));

            $payload->setMessage(__('actions.image.updated'));
        } catch (\Exception $exception) {
            $payload->setMessage($exception->getMessage());
        }

        return $payload;
    }

    public function destroy(Request $request): Message
    {
        $payload = new Message();

        try {
            /** @var ObjectImage $objectImage */
            $objectImage = $this->getByRequest($request);

            $this->imageUploader->clear(
                new ImageUpload(
                    sprintf('%s.%s', $objectImage->filename, $objectImage->ext),
                    ObjectImagePath::pathWithObject($objectImage->object_id)
                )
            );

            $this->commandHandler->execute(new DestroyCommand($request));

            $payload->setMessage(__('actions.image.destroyed'));
        } catch (\Exception $exception) {
            $payload->setMessage($exception->getMessage());
        }

        return $payload;
    }
}
