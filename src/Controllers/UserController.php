<?php
declare(strict_types=1);
// File: src/Controllers/UserController.php

namespace App\Controllers;
use App\Core\Request;
use App\Services\UserService;

class UserController extends BaseController {
    public function __construct(private UserService $userService) {
        parent::__construct();
        // TODO: implement
    }

    public function index(Request $request): void {
        // TODO: implement
    }

    public function create(Request $request): void {
        // TODO: implement
    }

    public function store(Request $request): void {
        // TODO: implement
    }

    public function edit(Request $request): void {
        // TODO: implement
    }

    public function update(Request $request): void {
        // TODO: implement
    }

    public function destroy(Request $request): void {
        // TODO: implement
    }
}
