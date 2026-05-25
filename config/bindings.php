<?php
declare(strict_types=1);
// File: config/bindings.php

use App\Core\Container;
use App\Models\User;
use App\Services\{AuthService, UserService, FileUploadService};
use App\Controllers\{AuthController, UserController, WelcomeController};

// Models
$container->bind(User::class, fn(Container $c): object => new User());

// Services
$container->bind(FileUploadService::class, fn(Container $c): object => new FileUploadService(BASE_PATH . '/storage/uploads'));
$container->bind(AuthService::class, fn(Container $c): object => new AuthService($c->make(User::class)));
$container->bind(UserService::class, fn(Container $c): object => new UserService($c->make(User::class)));

// Controllers
$container->bind(WelcomeController::class, fn(Container $c): object => new WelcomeController());
$container->bind(AuthController::class, fn(Container $c): object => new AuthController($c->make(AuthService::class)));
$container->bind(UserController::class, fn(Container $c): object => new UserController($c->make(UserService::class)));
