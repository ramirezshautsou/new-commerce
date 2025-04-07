<?php

namespace App\Services;

use App\Http\Requests\ProducerRequest;
use App\Models\Producer;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;

class ProducerService
{
    /**
     * @param ProducerRepositoryInterface $producerRepository
     */
    public function __construct(
        protected ProducerRepositoryInterface $producerRepository,
    ) {}

    /**
     * @param ProducerRequest $request
     * @param int $producerId
     *
     * @return Producer
     */
    public function updateProducer(ProducerRequest $request, int $producerId): Producer
    {
        $producer = $this->producerRepository
            ->findById($producerId);
        $producer->update($request->validated());

        return $producer;
    }

    /**
     * @param int $producerId
     *
     * @return void
     */
    public function deleteProducer(int $producerId): void
    {
        $producer = $this->producerRepository
            ->findById($producerId);
        $producer->delete();
    }
}
