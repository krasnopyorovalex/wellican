<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Persistence\Storage\Resources\CollectionResource;
use Domain\Persistence\Storage\Resources\PaginatorResource;
use Domain\Persistence\Storage\ValueObjects\WithRelations;
use Illuminate\Database\Eloquent\Model;

final readonly class GetAllQuery implements Command
{
    public function __construct(
        private Request $request,
        private Model $model,
        private ?WithRelations $withRelations = null
    ) {
    }

    public function handle(): DatabaseResource
    {
        $builder = $this->model::query();

        $builder->selectRaw($this->request->getSelectFields());

        foreach ($this->request->toWhere() as $key => $value) {
            $builder->where($key, $value);
        }

        if ($this->withRelations) {
            $builder->with($this->withRelations->getWith());
        }

        if ($this->request->getOrderBy()) {
            $builder->orderByRaw($this->request->getOrderBy());
        }

        return $this->request->getLimit()
            ? new PaginatorResource(
                $builder->paginate(
                    perPage: $this->request->getLimit(),
                    page: $this->request->getOffset()
                )
            )
            : new CollectionResource($builder->get());
    }
}
