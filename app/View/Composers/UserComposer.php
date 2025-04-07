<?php

namespace App\View\Composers;

use App\Repositories\UserRole\Interfaces\UserRoleRepositoryInterface;
use App\Repositories\UserRole\UserRoleRepository;

class UserComposer extends BaseComposer
{
    /**
     * @param UserRoleRepository $userRoleRepository
     */
    public function __construct(
        protected UserRoleRepositoryInterface $userRoleRepository,
    ) {
        parent::__construct([
            'roles' => $userRoleRepository,
        ]);
    }
}
