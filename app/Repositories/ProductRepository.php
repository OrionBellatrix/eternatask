<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function setModel(): string
    {
        return Product::class;
    }
}
