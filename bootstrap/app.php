<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->redirectGuestsTo('/signin');  // pastikan route ini ada dan bernama 'login'
        $middleware->alias([
            'role' => CheckRoleMiddleware::class,
            'auth.custom' => AuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
