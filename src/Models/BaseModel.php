<?php
declare(strict_types=1);
// File: src/Models/BaseModel.php

namespace App\Models;
use PDO;
use App\Core\Database;

abstract class BaseModel {
    protected PDO $db;
    protected string $table;
    protected string $primaryKey = 'id';
    protected array $sortableColumns = ['id', 'created_at', 'updated_at'];

    public function __construct() {
        // TODO: implement
    }

    public function all(array $conditions = [], string $orderBy = 'created_at', string $direction = 'DESC'): array {
        // TODO: implement
        return [];
    }

    public function find(int $id): ?array {
        // TODO: implement
        return null;
    }

    public function findWhere(array $conditions): ?array {
        // TODO: implement
        return null;
    }

    public function where(array $conditions, string $orderBy = 'created_at', string $direction = 'DESC'): array {
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

    public function count(array $conditions = []): int {
        // TODO: implement
        return 0;
    }

    public function exists(array $conditions): bool {
        // TODO: implement
        return false;
    }

    public function paginate(int $page = 1, int $perPage = 15, array $conditions = []): array {
        // TODO: implement
        return [];
    }

    protected function query(string $sql, array $bindings = []): array {
        // TODO: implement
        return [];
    }

    protected function execute(string $sql, array $bindings = []): bool {
        // TODO: implement
        return false;
    }

    private function validateSortColumn(string $column): string {
        // TODO: implement
        return '';
    }
}
