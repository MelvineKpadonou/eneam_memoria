<?php

namespace App\Http;

use App\Http\Middleware\CheckStudentProfile;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\HandleInertia;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfRole;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\ValidateMemoryAccess;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Foundation\Http\Middleware\ValidateSession;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ValidateCsrf;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     * These middleware are always executed during a request.
     *
     * @var array
     */
    protected $middleware = [
        ValidatePostSize::class,
        TrimStrings::class,
        SubstituteBindings::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            ValidateCsrf::class,
            HandleInertia::class,
            ValidateSession::class,
            RedirectIfAuthenticated::class,
        ],

        'api' => [
            SubstituteBindings::class,
            Authenticate::class,
            StartSession::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'cache.headers' => SetCacheHeaders::class,
        'can' => Authorize::class,
        'guest' => \Illuminate\Foundation\Http\Middleware\RedirectIfAuthenticated::class,
        'role' => RedirectIfRole::class,
        'check.student' => CheckStudentProfile::class,
        'validate.memory' => ValidateMemoryAccess::class,
    ];
}
