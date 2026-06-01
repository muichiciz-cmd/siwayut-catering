<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Core\Request;
use App\Services\OrderService;

class DashboardController extends BaseController {
    public function __construct(
        private OrderService $orderService
    ) {
        parent::__construct();
    }

    public function index(Request $request): void {
        $kpis = $this->orderService->getKpis();
        $topMenus = $this->orderService->getTopMenus(5);
        $chartData = $this->orderService->getRevenueChartData(7);
        $statusBreakdown = $this->orderService->getOrderStatusBreakdown();

        $this->render('dashboard/index', [
            'title' => __('dashboard') . ' — Siwayut Catering',
            'kpis' => $kpis,
            'topMenus' => $topMenus,
            'chartData' => $chartData,
            'statusBreakdown' => $statusBreakdown,
        ]);
    }
}
