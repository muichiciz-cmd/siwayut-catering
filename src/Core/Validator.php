<?php
declare(strict_types=1);
// File: src/Core/Validator.php

namespace App\Core;
use PDO;

class Validator {
    private array $errors = [];

    public function __construct(private ?PDO $db = null) {
        // TODO: implement
    }

    public function validate(array $data, array $rules): bool {
        // TODO: implement
        return false;
    }

    public function errors(): array {
        // TODO: implement
        return [];
    }

    public function error(string $field): ?string {
        // TODO: implement
        return null;
    }

    public function fails(): bool {
        // TODO: implement
        return false;
    }

    // CONTRACT: Rule parsing MUST use: explode(':', $rule, 3)
    // For "in:" rules, argument parsing MUST use: explode(',', $argument)
    private function applyRule(string $field, mixed $value, string $rule, array $data): bool {
        // TODO: implement
        return false;
    }
}
