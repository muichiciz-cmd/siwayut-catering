<?php
declare(strict_types=1);
// File: src/Services/MenuService.php

namespace App\Services;
use App\Models\Menu;

class MenuService {
    public function __construct(private Menu $menuModel, private FileUploadService $fileUploadService) {
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

    public function create(array $data, ?array $file = null): int {
        // TODO: implement
        return 0;
    }

    public function update(int $id, array $data, ?array $file = null): bool {
        // TODO: implement
        return false;
    }

    public function delete(int $id): bool {
        // TODO: implement
        return false;
    }
}
