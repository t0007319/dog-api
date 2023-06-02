<?php

namespace App\Providers;

use App\GraphQL\Queries\Breeds;
use App\GraphQL\Queries\Parks;
use App\GraphQL\Queries\Users;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class GraphQLServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton('graphql.types', function ($app) {
            return [
                'Query' => [
                    'users' => Users::class,
                    'breeds' => Breeds::class,
                    'parks' => Parks::class
                ]
            ];
        });
    }
}
