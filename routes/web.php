<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Get all routes starting with 'api/' or specific controllers
    $routes = collect(Route::getRoutes())->filter(function ($route) {
        return str_contains($route->uri(), 'api') || $route->getActionName() !== 'Closure';
    });

    return view('welcome', compact('routes'));
});
