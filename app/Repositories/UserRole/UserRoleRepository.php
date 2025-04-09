<?php

namespace App\Repositories\UserRole;

use App\Models\Role;
use App\Repositories\UserRole\Interfaces\UserRoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRoleRepository implements UserRoleRepositoryInterface
{
    /**
     * @param Role $model
     */
    public function __construct(
        protected Role $model
    ) {}

    /**
     * @param int|null $limit
     *
     * @return Collection
     */
    public function getAll(?int $limit = null): Collection
    {
        $query = $this->model->newQuery();

        if ($limit !== null) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * @param int $id
     *
     * @return Role
     */
    public function findById(int $id): Role
    {
        return $this->model->newQuery()
            ->findOrFail($id);
    }
}
