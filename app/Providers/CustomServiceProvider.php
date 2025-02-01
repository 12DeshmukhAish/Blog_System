<?php
// app/Providers/CustomServiceProvider.php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class CustomServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register any bindings or services
        $this->app->singleton('activity.logger', function ($app) {
            return new \App\Services\ActivityLogger();
        });
    }

    public function boot()
    {
        // Add custom logging channel configuration
        Config::set('logging.channels.user-activity', [
            'driver' => 'daily',
            'path' => storage_path('logs/user-activity.log'),
            'level' => 'info',
            'days' => 14,
        ]);
    }
}
