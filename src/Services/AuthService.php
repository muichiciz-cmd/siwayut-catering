<?php
declare(strict_types=1);
// File: src/Services/AuthService.php

namespace App\Services;
use App\Models\User;

class AuthService {
    public function __construct(private User $userModel) {
        // TODO: implement
    }

    public function login(string $email, string $password): bool {
        // TODO: implement
        return false;
    }

    public function logout(): void {
        // TODO: implement
    }
}
