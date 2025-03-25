<?php

namespace App\View\Composers;

use App\Repositories\Product\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Product\Interfaces\ProducerRepositoryInterface;
use Illuminate\View\View;

class ProductComposer
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
        protected ProducerRepositoryInterface $producerRepository,
    ) {}

    public function compose(View $view): void
    {
        $view->with([
            'categories' => $this->categoryRepository->getAll(),
            'producers' => $this->producerRepository->getAll(),
        ]);
    }
}
