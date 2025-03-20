<?php

namespace App\Repositories\User\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function paginate(int $limitPerPage): LengthAwarePaginator;
}
