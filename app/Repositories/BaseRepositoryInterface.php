<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    public function paginate(int $page = 20, array $columns = ['*'], array $relations = []): LengthAwarePaginator;

    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model;

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
