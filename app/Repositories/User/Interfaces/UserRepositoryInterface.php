<?php

namespace App\Repositories\User\Interfaces;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $id
     *
     * @return User
     */
    public function findById(int $id): User;

    /**
     * @param array $data
     *
     * @return User
     */
    public function create(array $data): User;

    /**
     * @param int $id
     * @param array $data
     *
     * @return User
     */
    public function update(int $id, array $data): User;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param int $limitPerPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $limitPerPage): LengthAwarePaginator;

    /**
     * @param array $credentials
     *
     * @return bool
     */
    public function attemptLogin(array $credentials): bool;

    /**
     * @return void
     */
    public function logoutUser(): void;

    /**
     * @return Authenticatable|null
     */
    public function getAuthenticatedUser(): ?Authenticatable;
}
