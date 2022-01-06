<?php

namespace App\Providers;

use App\Models\Message;
use App\Observers\MessageObserver;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        //bugfix to migrate error
        Schema::defaultStringLength(191);

        //remove data to API object
        JsonResource::withoutWrapping();

        //Add MessageObserver to Message model
        Message::observe(MessageObserver::class);
    }
}
