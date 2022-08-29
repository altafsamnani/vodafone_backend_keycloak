<?php

namespace App\Repository\Contract;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repositories
 */
interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     *
     * @return Model
     */
    public function find($id): ?Model;

    /**
     *
     * @return Collection
     */
    public function all(): ?Collection;

    /**
     *
     * @return int
     */
    public function restore(): int;

}
