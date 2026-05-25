<?php
declare(strict_types=1);
// File: src/Services/UserService.php

namespace App\Services;
use App\Models\User;

class UserService {
    public function __construct(private User $userModel) {
        // TODO: implement
    }

    public function getAll(int $page = 1, int $perPage = 15): array {
        // TODO: implement
        return [];
    }

    public function getById(int $id): array {
        // TODO: implement
        return [];
    }

    public function create(array $data): int {
        // TODO: implement
        return 0;
    }

    public function update(int $id, array $data): bool {
        // TODO: implement
        return false;
    }

    public function delete(int $id): bool {
        // TODO: implement
        return false;
    }
}
