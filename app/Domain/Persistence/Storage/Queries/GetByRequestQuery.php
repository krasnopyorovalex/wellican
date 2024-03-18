<?php

declare(strict_types=1);

namespace Domain\Persistence\Storage\Queries;

use Domain\Contracts\Http\Request;
use Domain\Contracts\Persistence\Command;
use Domain\Contracts\Persistence\DatabaseResource;
use Domain\Persistence\Storage\Resources\SingleRecourse;
use Domain\Persistence\Storage\ValueObjects\Select;
use Domain\Persistence\Storage\ValueObjects\WithRelations;
use Illuminate\Database\Eloquent\Model;

final readonly class GetByRequestQuery implements Command
{
    public function __construct(
        private Request $request,
        private Model $model,
        private ?WithRelations $withRelations = null,
        private ?Select $select = null
    ) {
    }

    public function handle(): DatabaseResource
    {
        $builder = $this->model::query();

        if ($this->select) {
            $builder->selectRaw($this->select->getSelectCols());
        }

        foreach ($this->request->toWhere() as $key => $value) {
            $builder->where($key, $value);
        }

        if ($this->withRelations) {
            $builder->with($this->withRelations->getWith());
        }

        return new SingleRecourse($builder->firstOrFail());
    }
}
