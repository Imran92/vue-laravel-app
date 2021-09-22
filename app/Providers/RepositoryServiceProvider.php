<?php

namespace App\Providers;

use App\Contracts\Repositories\EloquentRepositoryInterface;
use App\Contracts\Repositories\ResourceRepositoryInterface;
use App\Contracts\Services\ResourceServiceInterface;
use App\Repositories\Eloquent\ResourceRepository;
use App\Repositories\Eloquent\BaseRepository;
use App\Services\ResourceService;
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
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(ResourceRepositoryInterface::class, ResourceRepository::class);

        $this->app->bind(ResourceServiceInterface::class, ResourceService::class);
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
