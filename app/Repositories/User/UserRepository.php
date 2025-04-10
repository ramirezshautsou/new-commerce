<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param User $model
     */
    public function __construct(
        protected User $model
    ) {}

    /**
     * @param int $limitPerPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $limitPerPage): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->with('role')
            ->paginate($limitPerPage);
    }

    /**
     * @param array $credentials
     *
     * @return bool
     */
    public function attemptLogin(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    /**
     * @return void
     */
    public function logoutUser(): void
    {
        Auth::logout();
    }

    /**
     * @return Authenticatable|null
     */
    public function getAuthenticatedUser(): ?Authenticatable
    {
        return Auth::user();
    }

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
     * @return User
     */
    public function findById(int $id): User
    {
        return $this->model->newQuery()
            ->findOrFail($id);
    }

    /**
     * @param array $data
     *
     * @return User
     */
    public function create(array $data): User
    {
        return $this->model->newQuery()
            ->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return User
     */
    public function update(int $id, array $data): User
    {
        $user = $this->model->newQuery()
            ->findOrFail($id);
        $user->update($data);

        return $user;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return (bool) $this->model->newQuery()
            ->find($id)
            ?->delete();
    }
}
