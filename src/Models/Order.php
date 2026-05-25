<?php
declare(strict_types=1);
// File: src/Models/Order.php

namespace App\Models;

class Order extends BaseModel {
    public function __construct() {
        parent::__construct();
        // TODO: implement
    }

    public function items(int $orderId): array {
        // TODO: implement
        return [];
    }

    public function customer(int $customerId): ?array {
        // TODO: implement
        return null;
    }

    public function updateStatus(int $id, string $status): bool {
        // TODO: implement
        return false;
    }
}
