<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRole\UserRoleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    private const PAGE_LIMIT = 10;

    protected string $name;

    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected UserRoleRepository      $userRoleRepository,
    )
    {
        $this->name = __('entities.user');
    }

    public function index(): View
    {
        return view('admin.users.index', [
            'users' => $this->userRepository
                ->paginate(self::PAGE_LIMIT),
        ]);
    }

    public function show(int $userId): View
    {
        return view('admin.users.show', [
            'user' => $this->userRepository
                ->findById($userId),
            'roles' => $this->userRoleRepository
                ->getAll(),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'roles' => $this->userRoleRepository
                ->getAll(),
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->userRepository
            ->create($request->validated());

        return redirect(route('admin.users.index'))
            ->with('success', __('messages.create_success', [
                'name' => $this->name,
            ]));
    }

    public function edit(int $userId): View
    {
        return view('admin.users.edit', [
            'user' => $this->userRepository
                ->findById($userId),
            'roles' => $this->userRoleRepository
                ->getAll(),
        ]);
    }

    public function update(UserRequest $request, int $userId): RedirectResponse
    {
        $user = $this->userRepository
            ->findById($userId);
        $user->update($request->validated());

        return redirect(route('admin.users.index'))
            ->with('success', __('messages.update_success', [
                'name' => $this->name,
            ]));
    }

    public function destroy(int $userId): RedirectResponse
    {
        $user = $this->userRepository
            ->findById($userId);
        $user->delete();

        return redirect(route('admin.users.index'))
            ->with('success', __('messages.delete_success', [
                'name' => $this->name,
            ]));
    }
}
