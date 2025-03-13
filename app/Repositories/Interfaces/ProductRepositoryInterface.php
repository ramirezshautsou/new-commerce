<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function paginate(int $limitPerPage);
}
