<?php
declare(strict_types=1);
// File: src/Services/OrderService.php

namespace App\Services;
use App\Models\{Order, OrderItem, Menu};

class OrderService {
    public function __construct(private Order $orderModel, private OrderItem $orderItemModel, private Menu $menuModel) {
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

    public function create(array $data, array $items): int {
        // TODO: implement
        return 0;
    }

    public function updateStatus(int $id, string $status): bool {
        // TODO: implement
        return false;
    }
}
