<?php
declare(strict_types=1);
// File: src/Controllers/AuthController.php

namespace App\Controllers;
use App\Core\Request;
use App\Services\AuthService;

class AuthController extends BaseController {
    public function __construct(private AuthService $authService) {
        parent::__construct();
        // TODO: implement
    }

    public function index(Request $request): void {
        // TODO: implement
    }

    public function login(Request $request): void {
        // TODO: implement
    }

    public function logout(Request $request): void {
        // TODO: implement
    }
}
