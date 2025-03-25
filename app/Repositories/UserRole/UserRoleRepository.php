<?php

namespace App\Repositories\UserRole;

use App\Models\Role;
use App\Repositories\BaseRepository;

class UserRoleRepository extends BaseRepository
{
    /**
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
