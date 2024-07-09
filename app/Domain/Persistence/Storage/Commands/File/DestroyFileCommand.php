<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Commands\File;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Image\Uploader;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Entities\Image\Image;
use Domain\Persistence\Configs\FilePath;
use Domain\Persistence\Storage\Resources\SingleRecourse;
use Domain\Services\ImageUploader\DataTransferObjects\FileUpload;
use Illuminate\Database\Eloquent\Model;

final readonly class DestroyFileCommand implements Command
{
    public function __construct(
        private Uploader $uploader,
        private Request $request,
        private Model $model
    ) {
    }

    public function handle(): DatabaseResource
    {
        /** @var Image $file */
        $file = $this->model::query()
            ->where('id', $this->request->getId())
            ->firstOrFail();

        $basename = sprintf('%s.%s', $file->filename, $file->ext);
        $this->uploader->clear(new FileUpload($basename, FilePath::createDir($file->imageable_type)));

        $file->delete();

        return new SingleRecourse($file);
    }
}
