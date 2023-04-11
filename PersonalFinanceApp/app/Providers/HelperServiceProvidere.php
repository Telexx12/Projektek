<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvidere extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $allHelperFiles = glob(app_path('Helpers') . '/*.php');
        foreach ($allHelperFiles as $key => $helperFile){
            require_once $helperFile;
        }
    }
}
