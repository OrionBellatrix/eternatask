<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    public function setModel(): string
    {
        return Category::class;
    }
}
