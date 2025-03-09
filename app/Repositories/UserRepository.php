<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function setModel(): string
    {
        return User::class;
    }

    /**
     * @param string $value
     * @return Model|null
     */
    public function findEmailOrUsername(string $value): ?Model
    {
        return $this->model->where('email', $value)->orWhere('username', $value)->first();
    }
}
