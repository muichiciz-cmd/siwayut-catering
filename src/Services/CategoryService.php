<?php
declare(strict_types=1);
// File: src/Services/CategoryService.php

namespace App\Services;
use App\Models\Category;

class CategoryService {
    public function __construct(private Category $categoryModel) {
        // TODO: implement
    }

    public function getAll(): array {
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
