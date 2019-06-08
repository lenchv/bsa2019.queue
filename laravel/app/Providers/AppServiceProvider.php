<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\UserRepository as UserRepositoryContract;
use App\Contracts\Services\UserService as UserServiceContract;

use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(UserServiceContract::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
