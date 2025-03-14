<?php

namespace App\Repositories\Service\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface ServiceRepositoryInterface
{
    /**
     * @param int $limitPerPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $limitPerPage): LengthAwarePaginator;
}
