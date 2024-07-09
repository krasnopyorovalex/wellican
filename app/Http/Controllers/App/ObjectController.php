<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Object\Objects;
use Domain\Entities\Object\Requests\ObjectRequest;
use Domain\Entities\Object\ValueObjects\SelectCols;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Domain\Persistence\Storage\ValueObjects\Select;
use Domain\Persistence\Storage\ValueObjects\WithRelations;
use Domain\Services\RelatedObjects\DataTransferObjects\RelatedObjectsData;
use Domain\Services\RelatedObjects\RelatedObjectsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ObjectController extends Controller
{
    public function __construct(private readonly Storage $storage, private readonly RelatedObjectsService $relatedObjectsService)
    {
    }

    public function __invoke(string $alias): View|\Illuminate\Foundation\Application|Factory|Application
    {
        /** @var Objects $object */
        $object = $this->storage->getByQuery(
            new GetByRequestQuery(
                ObjectRequest::fromArray(['alias' => $alias]),
                new Objects(),
                new WithRelations(['images', 'type', 'filterOptions.filter']),
                new Select(SelectCols::COLS)
            )
        );

        $relatedObjects = $this->relatedObjectsService->search(
            new RelatedObjectsData(
                $object->id,
                $object->type_id,
                (int) preg_replace('/\s+/', '', $object->price),
                (float) preg_replace('/\s+/', '', (string) $object->square)
            )
        );

        return view('app.objects.index', ['object' => $object, 'relatedObjects' => $relatedObjects]);
    }
}
