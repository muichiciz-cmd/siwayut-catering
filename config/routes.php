<?php
declare(strict_types=1);
// File: config/routes.php

use App\Core\Router;
use App\Controllers\{AuthController, UserController, WelcomeController};

return function (Router $router): void {
    $router->get('/', [WelcomeController::class, 'index']);

    $router->get('/login',   [AuthController::class, 'index']);
    $router->post('/login',  [AuthController::class, 'login']);
    $router->post('/logout', [AuthController::class, 'logout']);

    $router->group(['middleware' => ['auth'], 'prefix' => ''], function (Router $r): void {
        $r->group(['middleware' => ['role:admin']], function (Router $r): void {
            $r->get('/users',              [UserController::class, 'index']);
            $r->get('/users/create',       [UserController::class, 'create']);
            $r->post('/users',             [UserController::class, 'store']);
            $r->get('/users/{id}/edit',    [UserController::class, 'edit']);
            $r->post('/users/{id}',        [UserController::class, 'update']);
            $r->post('/users/{id}/delete', [UserController::class, 'destroy']);
        });
    });
};
