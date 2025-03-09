<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    public function __construct()
    {
        $modelClass = $this->setModel();
        $this->model = new $modelClass;
    }

    /**
     * @return string
     */
    abstract public function setModel(): string;

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * @param int $page
     * @param array $columns
     * @param array $relations
     * @return LengthAwarePaginator
     */
    public function paginate(int $page = 20, array $columns = ['*'], array $relations = []): LengthAwarePaginator
    {
        return $this->getModel()->with($relations)->paginate($page, $columns);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param string $slug
     * @return Model
     */
    public function findBySlug(string $slug): Model
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model
    {
        $model = $this->model->findOrFail($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $model = $this->model->findOrFail($id);
        return $model->delete();
    }

    /**
     * @return $this
     */
    public function getByAuthenticatedUser(int|bool $id = false): self
    {
        if ($id) {
            $this->model->where('user_id', $id);
        }
        else {
            $this->model->where('user_id', auth()->id());
        }

        return $this;
    }
}
