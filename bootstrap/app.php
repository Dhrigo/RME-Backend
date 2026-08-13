<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

spl_autoload_register(static function (string $class): void {
    if (! str_starts_with($class, 'Modules\\')) {
        return;
    }

    $rel = substr($class, 8);
    [$module, $rest] = array_pad(explode('\\', $rel, 2), 2, '');
    $mapping = [
        'Database\Factories\\' => 'database/factories/',
        'Database\Seeders\\' => 'database/seeders/',
        'Tests\\' => 'tests/',
    ];

    $subdir = 'app/';

    foreach ($mapping as $prefix => $dir) {
        if (str_starts_with($rest, $prefix)) {
            $subdir = $dir;
            $rest = substr($rest, strlen($prefix));
            break;
        }
    }

    $path = __DIR__.'/../Modules/'.$module.'/'.$subdir.str_replace('\\', '/', $rest).'.php';

    if (is_file($path)) {
        require_once $path;
    }
});

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
