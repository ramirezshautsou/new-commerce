<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRole\UserRoleRepository;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Model;
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
     * @param UserService $userService
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected UserService             $userService,
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
            'user' => $this->findOrFail($userId),
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
            'user' => $this->findOrFail($userId),
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
            ->updateUser($request->validated(), $userId);

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

    private function findOrFail(int $userId): Model
    {
        return $this->userRepository->findById($userId)
            ?? abort(404, __('messages.user_not_found'));
    }
}
