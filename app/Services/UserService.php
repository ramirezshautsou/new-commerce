<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {}

    /**
     * @param UserRequest $request
     * @param int $userId
     *
     * @return Model
     */
    public function updateUser(UserRequest $request, int $userId): Model
    {
        $user = $this->userRepository
            ->findById($userId);
        $user->update($request->validated());

        return $user;
    }

    /**
     * @param int $userId
     *
     * @return void
     */
    public function deleteUser(int $userId): void
    {
        $user = $this->userRepository
            ->findById($userId);
        $user->delete();
    }
}
