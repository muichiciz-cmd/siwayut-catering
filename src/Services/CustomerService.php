<?php
declare(strict_types=1);
// File: src/Services/CustomerService.php

namespace App\Services;
use App\Models\{Customer, Order};

class CustomerService {
    public function __construct(private Customer $customerModel, private Order $orderModel) {
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

    public function getCustomerOrders(int $customerId): array {
        // TODO: implement
        return [];
    }
}
