<?php

namespace App\Repositories\UserRole\Interfaces;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

interface UserRoleRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     *
     * @return Role
     */
    public function findById(int $id): Role;
}
