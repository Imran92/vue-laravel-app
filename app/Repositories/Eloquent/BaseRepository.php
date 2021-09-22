<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param Model $model
     *
     * @return Model
     */
    public function save(Model $model): Model
    {
        $model->save();
        return $model->fresh();
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
    /**
     * @param $id
     * @return int
     */
    public function delete($id): int
    {
        return $this->model->where('id',$id)->delete();
    }
}
