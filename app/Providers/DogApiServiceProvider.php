<?php

namespace App\Providers;

use App\Services\DogApiService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class DogApiServiceProvider extends ServiceProvider
{
    public const BASE_URL = 'https://dog.ceo/api/';
    public const TIMEOUT = 5;

    protected $client;

    /**
     * Boot services.
     *
     * @return void
     */
    public function boot()
    {
        Http::macro('dogApi', function () {
            return Http::baseUrl(DogApiServiceProvider::BASE_URL)
                ->timeout(DogApiServiceProvider::TIMEOUT);
        });
    }
}
