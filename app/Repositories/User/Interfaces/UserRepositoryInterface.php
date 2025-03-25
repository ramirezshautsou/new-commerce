<?php

namespace App\Repositories\User\Interfaces;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
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
