<?php
declare(strict_types=1);
// File: src/Controllers/ReportController.php

namespace App\Controllers;
use App\Core\Request;
use App\Services\ReportService;

class ReportController extends BaseController {
    public function __construct(private ReportService $reportService) {
        parent::__construct();
        // TODO: implement
    }

    public function index(Request $request): void {
        // TODO: implement
    }
}
