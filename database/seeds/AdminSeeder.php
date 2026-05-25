<?php
declare(strict_types=1);
// File: database/seeds/AdminSeeder.php

namespace Database\Seeds;

define('BASE_PATH', dirname(__DIR__, 2));
require BASE_PATH . '/vendor/autoload.php';

if (file_exists(BASE_PATH . '/.env')) {
    $env = parse_ini_file(BASE_PATH . '/.env');
    if ($env !== false) {
        foreach ($env as $key => $value) {
            $_ENV[$key] = $value;
        }
    }
}

require BASE_PATH . '/config/app.php';

use App\Core\Database;

class AdminSeeder {
    public static function run(): void {
        // TODO: implement
    }
}

AdminSeeder::run();
