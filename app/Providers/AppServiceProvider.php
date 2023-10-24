<?php

namespace App\Providers;

use App\Http\Services\ChatGPT\ChatGPTDummyService;
use App\Http\Services\ChatGPT\ChatGPTService;
use App\Interfaces\ChatGPTServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ChatGPTServiceInterface::class, function () {
            if (config('app.env') === 'production' || config('app.env') === 'testing') {
                return $this->app->make(ChatGPTService::class);
            }

            return $this->app->make(ChatGPTDummyService::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
