<?php
declare(strict_types=1);
// File: config/bindings.php

use App\Core\Container;
use App\Models\{User, Menu, Category, Order, OrderItem, Customer};
use App\Services\{AuthService, MenuService, CategoryService, OrderService, CustomerService, ReportService, UserService, FileUploadService};
use App\Controllers\{AuthController, DashboardController, MenuController, CategoryController, OrderController, CustomerController, ReportController, UserController};

// Models
$container->bind(User::class, fn(Container $c): object => new User());
$container->bind(Menu::class, fn(Container $c): object => new Menu());
$container->bind(Category::class, fn(Container $c): object => new Category());
$container->bind(Order::class, fn(Container $c): object => new Order());
$container->bind(OrderItem::class, fn(Container $c): object => new OrderItem());
$container->bind(Customer::class, fn(Container $c): object => new Customer());

// Services
$container->bind(FileUploadService::class, fn(Container $c): object => new FileUploadService(BASE_PATH . '/storage/uploads'));
$container->bind(AuthService::class, fn(Container $c): object => new AuthService($c->make(User::class)));
$container->bind(MenuService::class, fn(Container $c): object => new MenuService($c->make(Menu::class), $c->make(FileUploadService::class)));
$container->bind(CategoryService::class, fn(Container $c): object => new CategoryService($c->make(Category::class)));
$container->bind(OrderService::class, fn(Container $c): object => new OrderService($c->make(Order::class), $c->make(OrderItem::class), $c->make(Menu::class)));
$container->bind(CustomerService::class, fn(Container $c): object => new CustomerService($c->make(Customer::class), $c->make(Order::class)));
$container->bind(ReportService::class, fn(Container $c): object => new ReportService($c->make(Order::class)));
$container->bind(UserService::class, fn(Container $c): object => new UserService($c->make(User::class)));

// Controllers
$container->bind(AuthController::class, fn(Container $c): object => new AuthController($c->make(AuthService::class)));
$container->bind(DashboardController::class, fn(Container $c): object => new DashboardController($c->make(OrderService::class), $c->make(ReportService::class)));
$container->bind(MenuController::class, fn(Container $c): object => new MenuController($c->make(MenuService::class), $c->make(CategoryService::class)));
$container->bind(CategoryController::class, fn(Container $c): object => new CategoryController($c->make(CategoryService::class)));
$container->bind(OrderController::class, fn(Container $c): object => new OrderController($c->make(OrderService::class)));
$container->bind(CustomerController::class, fn(Container $c): object => new CustomerController($c->make(CustomerService::class)));
$container->bind(ReportController::class, fn(Container $c): object => new ReportController($c->make(ReportService::class)));
$container->bind(UserController::class, fn(Container $c): object => new UserController($c->make(UserService::class)));
