<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {}

    /**
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     *
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if ($this->userRepository->attemptLogin($request->validated())) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => __('messages.auth_failed'),
        ]);
    }

    /**
     * @return View
     */
    public function showRegistrationForm(): View
    {
        return view('auth.registration');
    }

    /**
     * @param AuthRequest $request
     *
     * @return RedirectResponse
     */
    public function registration(AuthRequest $request): RedirectResponse
    {
        $this->userRepository
            ->create($request->validated());

        return redirect(route('auth.login'))
            ->with('success', __('messages.registration_success'));
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->userRepository->logoutUser();

        return redirect()->intended('/');
    }
}
