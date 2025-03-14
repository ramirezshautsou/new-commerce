<?php

namespace App\Repositories\Service\Interfaces;

use App\Models\Services\ServiceType;

interface ServiceTypeRepositoryInterface
{
    /**
     * @param int $serviceId
     *
     * @return ServiceType
     */
    public function getServiceTypeByService(int $serviceId): ServiceType;
}
