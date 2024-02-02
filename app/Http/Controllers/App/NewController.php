<?php

declare(strict_types=1);

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Domain\Contracts\Persistence\Storage;
use Domain\Entities\Info\Info;
use Domain\Entities\Info\Requests\InfoRequest;
use Domain\Persistence\Storage\Queries\GetByRequestQuery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class NewController extends Controller
{
    public function __construct(private readonly Storage $storage)
    {
    }

    public function __invoke(string $alias): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $info = $this->storage->getByQuery(new GetByRequestQuery(InfoRequest::fromArray(['alias' => $alias]), new Info()));

        return view('app.news.index', ['info' => $info]);
    }
}
