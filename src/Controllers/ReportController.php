<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Core\Request;
use App\Services\OrderService;

class ReportController extends BaseController {
    public function __construct(
        private OrderService $orderService
    ) {
        parent::__construct();
    }

    public function revenue(Request $request): void {
        $dateFrom = $request->input('date_from', date('Y-m-01'));
        $dateTo = $request->input('date_to', date('Y-m-t'));
        $data = $this->orderService->getRevenueByPeriod($dateFrom, $dateTo);

        $totals = [
            'orders' => array_sum(array_column($data, 'orders')),
            'revenue' => array_sum(array_column($data, 'revenue')),
            'profit' => array_sum(array_column($data, 'profit')),
        ];

        $this->render('report/revenue', [
            'title' => __('revenue_report') . ' — Siwayut Catering',
            'rows' => $data,
            'totals' => $totals,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
        ]);
    }

    public function menuRevenue(Request $request): void {
        $menus = $this->orderService->getTopMenus(100);

        $this->render('report/menu-revenue', [
            'title' => __('menu_revenue') . ' — Siwayut Catering',
            'menus' => $menus,
        ]);
    }

    public function exportCsv(Request $request): void {
        $dateFrom = $request->input('date_from', date('Y-m-01'));
        $dateTo = $request->input('date_to', date('Y-m-t'));
        $data = $this->orderService->getRevenueByPeriod($dateFrom, $dateTo);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="revenue-' . $dateFrom . '-to-' . $dateTo . '.csv"');

        $out = fopen('php://output', 'w');
        fputcsv($out, [__('date'), __('total_orders'), __('revenue'), __('profit')]);
        foreach ($data as $row) {
            fputcsv($out, [$row['date'], (int)$row['orders'], (float)$row['revenue'], (float)$row['profit']]);
        }
        fclose($out);
        exit;
    }
}
