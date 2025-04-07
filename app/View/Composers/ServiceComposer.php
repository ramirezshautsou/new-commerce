<?php

namespace App\View\Composers;

use App\Repositories\Service\Interfaces\ServiceRepositoryInterface;

class ServiceComposer extends BaseComposer
{
    /**
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(
        protected ServiceRepositoryInterface $serviceRepository,
    ) {
        parent::__construct([
            'services' => $serviceRepository,
        ]);
    }
}
