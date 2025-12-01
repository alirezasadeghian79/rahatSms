<?php

namespace rahatSms\Providers;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/rahatSms.php',
            'sendSms'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/rahatSms.php' => config_path('rahatSms.php'),
        ], 'sendSms-config');

    }
}
