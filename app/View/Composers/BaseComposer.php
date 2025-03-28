<?php

namespace App\View\Composers;

use App\View\Composers\Interfaces\BaseComposerInterface;
use Illuminate\View\View;

abstract class BaseComposer implements BaseComposerInterface
{
    /**
     * @param array $repositories
     */
    public function __construct(
        protected readonly array $repositories,
    ) {}

    /**
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view): void
    {
        foreach ($this->repositories as $key => $repository) {
            $view->with($key, $repository->getAll());
        }
    }
}
