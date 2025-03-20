<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function paginate(int $limitPerPage): LengthAwarePaginator
    {
        return User::query()->with('role')->paginate($limitPerPage);
    }
}
