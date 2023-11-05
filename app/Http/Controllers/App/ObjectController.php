<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Domain\Entities\Object\ValueObjects\SelectCols;
use App\Http\Controllers\Controller;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Object\Objects;
use Domain\Entities\Object\Requests\ObjectRequest;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Domain\Persistence\Storage\ValueObjects\Select;
use Domain\Persistence\Storage\ValueObjects\WithRelations;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ObjectController extends Controller
{
    public function __construct(private readonly Storage $storage)
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

        return view('app.objects.index', ['object' => $object]);
    }
}
