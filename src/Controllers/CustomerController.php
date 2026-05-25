<?php
declare(strict_types=1);
// File: src/Controllers/CustomerController.php

namespace App\Controllers;
use App\Core\Request;
use App\Services\CustomerService;

class CustomerController extends BaseController {
    public function __construct(private CustomerService $customerService) {
        parent::__construct();
        // TODO: implement
    }

    public function index(Request $request): void {
        // TODO: implement
    }

    public function show(Request $request): void {
        // TODO: implement
    }
}
