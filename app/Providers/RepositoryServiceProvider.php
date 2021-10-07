<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\Eloquent\RecordRepository;
use App\Repository\RecordRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\Eloquent\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepository::class, BaseRepository::class);
        $this->app->bind(RecordRepositoryInterface::class, RecordRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

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
