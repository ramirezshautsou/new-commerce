<?php

namespace App\Services;

use App\Http\Requests\ServiceRequest;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ServiceService
{
    public function __construct(
        protected ServiceRepositoryInterface $serviceRepository,
    ) {}

    public function updateService(ServiceRequest $request, int $serviceId): Model
    {
        $service = $this->serviceRepository
            ->findById($serviceId);
        $service->update($request->validated());

        return $service;
    }

    public function deleteService(int $serviceId): void
    {
        $serviceId = $this->serviceRepository
            ->findById($serviceId);
        $serviceId->delete();
    }
}
