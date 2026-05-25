<?php
declare(strict_types=1);
// File: src/Controllers/DashboardController.php

namespace App\Controllers;
use App\Core\Request;
use App\Services\{OrderService, ReportService};

class DashboardController extends BaseController {
    public function __construct(private OrderService $orderService, private ReportService $reportService) {
        parent::__construct();
        // TODO: implement
    }

    public function index(Request $request): void {
        $this->render('dashboard/index', ['title' => 'Dashboard']);
    }
}
