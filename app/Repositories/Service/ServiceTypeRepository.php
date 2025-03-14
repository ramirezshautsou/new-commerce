<?php

namespace App\Repositories\Service;

use App\Models\Services\ServiceType;
use App\Repositories\BaseRepository;
use App\Repositories\Service\Interfaces\ServiceTypeRepositoryInterface;

class ServiceTypeRepository extends BaseRepository implements ServiceTypeRepositoryInterface
{
    /**
     * @param ServiceType $model
     */
    public function __construct(ServiceType $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $serviceId
     *
     * @return ServiceType
     */
    public function getServiceTypeByService(int $serviceId): ServiceType
    {
        return ServiceType::with('products')->findOrFail($serviceId);
    }
}
