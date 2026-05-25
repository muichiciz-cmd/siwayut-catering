<?php
declare(strict_types=1);
// File: config/routes.php

use App\Core\Router;
use App\Controllers\{AuthController, DashboardController, MenuController, CategoryController, OrderController, CustomerController, ReportController, UserController};

return function (Router $router): void {
    $router->get('/', fn() => \App\Core\Response::redirect('/dashboard'));

    $router->get('/login',   [AuthController::class, 'index']);
    $router->post('/login',  [AuthController::class, 'login']);
    $router->post('/logout', [AuthController::class, 'logout']);

    $router->group(['middleware' => ['auth'], 'prefix' => ''], function (Router $r): void {
        $r->get('/dashboard', [DashboardController::class, 'index']);

        $r->get('/menu',                [MenuController::class, 'index']);
        $r->get('/menu/create',         [MenuController::class, 'create']);
        $r->post('/menu',               [MenuController::class, 'store']);
        $r->get('/menu/{id}/edit',      [MenuController::class, 'edit']);
        $r->post('/menu/{id}',          [MenuController::class, 'update']);
        $r->post('/menu/{id}/delete',   [MenuController::class, 'destroy']);

        $r->get('/category',                [CategoryController::class, 'index']);
        $r->get('/category/create',         [CategoryController::class, 'create']);
        $r->post('/category',               [CategoryController::class, 'store']);
        $r->get('/category/{id}/edit',      [CategoryController::class, 'edit']);
        $r->post('/category/{id}',          [CategoryController::class, 'update']);
        $r->post('/category/{id}/delete',   [CategoryController::class, 'destroy']);

        $r->get('/orders',              [OrderController::class, 'index']);
        $r->get('/orders/{id}',         [OrderController::class, 'show']);
        $r->post('/orders/{id}/status', [OrderController::class, 'updateStatus']);

        $r->get('/customers',      [CustomerController::class, 'index']);
        $r->get('/customers/{id}', [CustomerController::class, 'show']);

        $r->group(['middleware' => ['role:admin']], function (Router $r): void {
            $r->get('/reports', [ReportController::class, 'index']);

            $r->get('/users',              [UserController::class, 'index']);
            $r->get('/users/create',       [UserController::class, 'create']);
            $r->post('/users',             [UserController::class, 'store']);
            $r->get('/users/{id}/edit',    [UserController::class, 'edit']);
            $r->post('/users/{id}',        [UserController::class, 'update']);
            $r->post('/users/{id}/delete', [UserController::class, 'destroy']);
        });
    });
};
