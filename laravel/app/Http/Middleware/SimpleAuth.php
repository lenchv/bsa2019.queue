<?php

namespace App\Http\Middleware;

use Closure;
use App\Contracts\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class SimpleAuth
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = $request->headers->get('x-user-id');

        $this->authenticate((int) $userId);

        return $next($request);
    }

    private function authenticate(int $userId)
    {
        if ($userId <= 0) {
            return;
        }

        $user = $this->userRepository->getById($userId);

        if (is_null($user)) {
            return;
        }

        Auth::login($user);
    }
}
