<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 👇 Enregistrement de vos middlewares personnalisés
        $middleware->alias([
            'CheckStudentProfile' => \App\Http\Middleware\CheckStudentProfile::class,
            'RedirectIfRole' => \App\Http\Middleware\RedirectIfRole::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,

            // Ajoutez d'autres middlewares ici si besoin (ex: 'role' => ...)
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
