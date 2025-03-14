<?php

namespace App\Repositories\Service;

use App\Models\Services\Service;
use App\Repositories\BaseRepository;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    /**
     * @param Service $model
     */
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $limitPerPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $limitPerPage): LengthAwarePaginator
    {
        return Service::query()->with('serviceType')->paginate($limitPerPage);
    }
}
