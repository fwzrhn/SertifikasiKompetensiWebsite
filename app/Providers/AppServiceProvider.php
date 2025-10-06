<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SchoolProfile;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('schoolProfile'))
        {
            // Ambil data School Profile pertama
            $profile = SchoolProfile::first();

            // Share ke semua blade
            View::share('schoolProfile', $profile);
        }
    }
}
