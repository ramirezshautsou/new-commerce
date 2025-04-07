<?php

namespace App\Services;

use App\Http\Requests\ServiceRequest;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

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
     * @return Model
     */
    public function updateService(ServiceRequest $request, int $serviceId): Model
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
