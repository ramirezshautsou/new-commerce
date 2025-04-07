<?php

namespace App\Services;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;

class ServiceService
{
    /**
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(
        protected ServiceRepositoryInterface $serviceRepository,
    ) {}

    /**
     * @param ServiceRequest $request
     * @param int $serviceId
     *
     * @return Service
     */
    public function updateService(ServiceRequest $request, int $serviceId): Service
    {
        $service = $this->serviceRepository
            ->findById($serviceId);
        $service->update($request->validated());

        return $service;
    }

    /**
     * @param int $serviceId
     *
     * @return void
     */
    public function deleteService(int $serviceId): void
    {
        $serviceId = $this->serviceRepository
            ->findById($serviceId);
        $serviceId->delete();
    }
}
