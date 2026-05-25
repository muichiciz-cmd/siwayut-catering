<?php
declare(strict_types=1);
// File: src/Models/Customer.php

namespace App\Models;

class Customer extends BaseModel {
    public function __construct() {
        parent::__construct();
        // TODO: implement
    }

    public function orders(int $customerId): array {
        // TODO: implement
        return [];
    }
}
