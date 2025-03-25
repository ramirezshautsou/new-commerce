<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRole\UserRoleRepository;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @const PAGE_LIMIT
     */
    private const PAGE_LIMIT = 10;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param UserRoleRepository $userRoleRepository
     * @param UserService $userService
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected UserRoleRepository $userRoleRepository,
        private UserService             $userService,
    ) {}

    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => $this->userRepository
                ->paginate(self::PAGE_LIMIT),
        ]);
    }

    /**
     * @param int $userId
     *
     * @return View
     */
    public function show(int $userId): View
    {
        return view('admin.users.show', [
            'user' => $this->userRepository
                ->findById($userId),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * @param UserRequest $request
     *
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $this->userRepository
            ->create($request->validated());

        return redirect(route('admin.users.index'))
            ->with('success', __('messages.create_success', [
                'name' => __('entities.user'),
            ]));
    }

    /**
     * @param int $userId
     *
     * @return View
     */
    public function edit(int $userId): View
    {
        return view('admin.users.edit', [
            'user' => $this->userRepository
                ->findById($userId),
        ]);
    }

    /**
     * @param UserRequest $request
     * @param int $userId
     *
     * @return RedirectResponse
     */
    public function update(UserRequest $request, int $userId): RedirectResponse
    {
        $this->userService
            ->updateUser($request, $userId);

        return redirect(route('admin.users.index'))
            ->with('success', __('messages.update_success', [
                'name' => __('entities.user'),
            ]));
    }

    /**
     * @param int $userId
     *
     * @return RedirectResponse
     */
    public function destroy(int $userId): RedirectResponse
    {
        $this->userService
            ->deleteUser($userId);

        return redirect(route('admin.users.index'))
            ->with('success', __('messages.delete_success', [
                'name' => __('entities.user'),
            ]));
    }
}
