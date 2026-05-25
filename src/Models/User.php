<?php
declare(strict_types=1);
// File: src/Models/User.php

namespace App\Models;

class User extends BaseModel {
    public function __construct() {
        parent::__construct();
        // TODO: implement
    }

    public function findByEmail(string $email): ?array {
        // TODO: implement
        return null;
    }
}
