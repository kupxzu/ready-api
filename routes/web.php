<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $allRoutes = collect(Route::getRoutes());

    $data = [
        'admin'  => $allRoutes->filter(fn($r) => in_array('role:admin', $r->gatherMiddleware())),
        'client' => $allRoutes->filter(fn($r) => in_array('role:client', $r->gatherMiddleware())),
        'common' => $allRoutes->filter(fn($r) => 
            in_array('auth:sanctum', $r->gatherMiddleware()) && 
            !in_array('role:admin', $r->gatherMiddleware()) && 
            !in_array('role:client', $r->gatherMiddleware())
        ),
    ];

    return view('welcome', $data);
});