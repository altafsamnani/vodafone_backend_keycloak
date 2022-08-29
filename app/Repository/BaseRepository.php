<?php

namespace App\Repository;

use App\Repository\Contract\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
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
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
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
     * @return Collection
     */
    public function all() : ?Collection
    {
        return $this->model::withTrashed()->get();
    }

    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function update(array $attributes): Model
    {
        return $this->model->update($attributes);
    }

    /**
     *
     * @return int
     */
    public function restore(): int
    {
        return $this->model::onlyTrashed()->restore();
    }
}
