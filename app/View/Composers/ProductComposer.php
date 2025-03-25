<?php

namespace App\View\Composers;

use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;
use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;

class ProductComposer extends BaseComposer
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ProducerRepositoryInterface $producerRepository
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
        protected ProducerRepositoryInterface $producerRepository,
        protected ServiceRepositoryInterface $serviceRepository,
    ) {
        parent::__construct([
            'producers' => $producerRepository,
            'categories' => $categoryRepository,
            'services' => $serviceRepository,
        ]);
    }
}
