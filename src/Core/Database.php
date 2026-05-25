<?php
declare(strict_types=1);
// File: src/Core/Database.php

namespace App\Core;
use PDO;

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        // TODO: implement
        return new PDO('sqlite::memory:');
    }

    private function __construct() {
        // TODO: implement
    }

    private function __clone(): void {
        // TODO: implement
    }

    public function __wakeup(): never {
        throw new \Exception('Cannot unserialize singleton');
    }
}
