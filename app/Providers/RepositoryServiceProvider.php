<?php

namespace App\Providers;

use App\Http\Repositories\EventRepository;
use App\Http\Repositories\UserRepository;
use App\Interfaces\EventInterface;
use App\Interfaces\UserInterface;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            EventInterface::class, 
            EventRepository::class
        );

        $this->app->bind(
            UserInterface::class, 
            UserRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
