<?php

namespace App\Providers;

use App\Observers\CollegeObserver;
use Illuminate\Support\ServiceProvider;
use Modules\College\Entities\College;

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
        College::observe(CollegeObserver::class);

        // view()->composer('*', function ($view) {
        //     $view->with(['prefix' => explode("/", request()->route()->getPrefix())]);
        // });
    }
}
