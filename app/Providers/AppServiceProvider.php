<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        // list of (all) valid timezones
        $zoneList = timezone_identifiers_list();

        if ( Schema::hasTable('settings')) {

            // Get timezones value form settings table
            $settings = \App\Models\Setting::first();

            if ( $settings != null && in_array($settings->timezone, $zoneList)){
                date_default_timezone_set($settings->timezone ? $settings->timezone : config('app.timezone'));
            }

        } else {
            date_default_timezone_set(config('app.timezone'));
        }
    }
}
