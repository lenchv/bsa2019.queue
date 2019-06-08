<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Repositories\UserRepository;
use Illuminate\Http\Request;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Auth::viaRequest('simple-auth', function (Request $request) {
            $userRepository = $this->app->make(UserRepository::class);
            $userId = $request->headers->get('x-user-id');
            
            if (is_null($userId)) {
                return;
            }
            
            return $userRepository->getById((int) $userId);
        });
    }
}
