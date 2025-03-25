<?php

namespace App\View\Composers\Interfaces;

use Illuminate\View\View;

interface BaseComposerInterface
{
    /**
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view): void;
}
