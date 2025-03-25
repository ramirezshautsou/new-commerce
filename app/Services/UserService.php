<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {}

    public function updateUser(UserRequest $request, int $userId): Model
    {
        $user = $this->userRepository
            ->findById($userId);
        $user->update($request->validated());

        return $user;
    }

    public function deleteUser(int $userId): void
    {
        $user = $this->userRepository
            ->findById($userId);
        $user->delete();
    }
}
