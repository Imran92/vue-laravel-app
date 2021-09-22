<?php

namespace App\Contracts\Repositories;


use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * @param Model $model
     * @return Model
     */
    public function save(Model $model): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;
    /**
     * @param $id
     * @return int
     */
    public function delete($id): int;
}
