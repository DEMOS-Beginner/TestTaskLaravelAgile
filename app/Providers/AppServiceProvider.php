<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\TestRequest;
use App\Models\Message;
use App\Observers\RequestObserver;
use App\Observers\MessageObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TestRequest::observe(RequestObserver::class);
        Message::observe(MessageObserver::class);
    }
}
