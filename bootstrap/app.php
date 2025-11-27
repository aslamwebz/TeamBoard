<?php declare(strict_types=1);

use App\Http\Middleware\WorkerRoleMiddleware;
use App\Http\Middleware\ClientRoleMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->group('universal', []);
        $middleware->alias([
            'worker' => WorkerRoleMiddleware::class,
            'client' => ClientRoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
