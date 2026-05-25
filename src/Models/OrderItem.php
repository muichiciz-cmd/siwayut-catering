<?php
declare(strict_types=1);
// File: src/Models/OrderItem.php

namespace App\Models;

class OrderItem extends BaseModel {
    public function __construct() {
        parent::__construct();
        // TODO: implement
    }

    public function byOrder(int $orderId): array {
        // TODO: implement
        return [];
    }
}
