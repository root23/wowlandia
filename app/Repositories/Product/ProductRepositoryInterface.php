<?php

namespace App\Repositories\Product;

interface ProductRepositoryInterface {
    public function getAll();

    public function getById(int $id);
}
