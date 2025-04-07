<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Repositories\User\Interfaces\UserRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->role_id !== 1) {
            return response()->view('errors.403');
        }

        return $next($request);
    }
}
