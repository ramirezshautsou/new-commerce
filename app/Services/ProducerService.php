<?php

namespace App\Services;

use App\Http\Requests\ProducerRequest;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProducerService
{
    public function __construct(
        protected ProducerRepositoryInterface $producerRepository,
    ) {}

    public function updateProducer(ProducerRequest $request, int $producerId): Model
    {
        $producer = $this->producerRepository
            ->findById($producerId);
        $producer->update($request->validated());

        return $producer;
    }

    public function deleteProducer(int $producerId): void
    {
        $producer = $this->producerRepository
            ->findById($producerId);
        $producer->delete();
    }
}
