<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Repositories\UserRepository as UserRepositoryContract;
use App\Contracts\Services\UserService as UserServiceContract;
use App\Contracts\Services\ChatService as ChatServiceContract;
use App\Contracts\Repositories\MessageRepository as MessageRepositoryContract;

use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Support\Facades\Schema;
use App\Services\ChatService;
use App\Repositories\MessageRepository;

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
        $this->app->bind(ChatServiceContract::class, ChatService::class);
        $this->app->bind(MessageRepositoryContract::class, MessageRepository::class);
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
