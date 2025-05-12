<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Repositories\Contracts\ActivityRepositoryInterface;
use App\Repositories\Eloquent\ActivityRepository;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Relation::morphMap([
            'Contact'              => \App\Models\Contact::class,
            'App\\Models\\Contact' => \App\Models\Contact::class,
            'Deal'                 => \App\Models\Deal::class,
            'App\\Models\\Deal'    => \App\Models\Deal::class,
        ]);
    }

    public function register(): void
    {
        $this->app->bind(
            ActivityRepositoryInterface::class,
            ActivityRepository::class
        );
    }
}
