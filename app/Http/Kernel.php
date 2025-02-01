<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // ... other middlewares
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];
protected $middlewareGroups = [
    'web' => [
        // ... other middleware
        \App\Http\Middleware\LogUserActivity::class,
    ],
];
}