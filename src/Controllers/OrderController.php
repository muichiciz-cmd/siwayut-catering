<?php
declare(strict_types=1);
// File: src/Controllers/OrderController.php

namespace App\Controllers;
use App\Core\Request;
use App\Services\OrderService;

class OrderController extends BaseController {
    public function __construct(private OrderService $orderService) {
        parent::__construct();
        // TODO: implement
    }

    public function index(Request $request): void {
        // TODO: implement
    }

    public function show(Request $request): void {
        // TODO: implement
    }

    public function updateStatus(Request $request): void {
        // TODO: implement
    }
}
