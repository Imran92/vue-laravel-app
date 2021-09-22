<?php

namespace App\Repositories\Eloquent;

use App\Models\ResourceItem;
use App\Contracts\Repositories\ResourceRepositoryInterface;
use Illuminate\Support\Collection;

class ResourceRepository extends BaseRepository implements ResourceRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(ResourceItem $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }
}
