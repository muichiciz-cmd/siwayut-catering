<div class="mb-8">
    <h1 class="text-2xl font-bold font-display text-text"><?= __('dashboard') ?></h1>
    <div class="w-[50px] h-[1.5px] bg-gold shadow-[0_0_8px_rgba(229,142,38,0.3)] mt-1"></div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 hover:-translate-y-[3px] hover:border-gold/25 hover:shadow-[0_8px_30px_rgba(0,0,0,0.4)] transition-all duration-300">
        <div class="flex items-center gap-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gold shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            <span class="text-xs text-muted uppercase tracking-wider font-medium"><?= __('total_revenue') ?></span>
        </div>
        <div class="bg-gradient-to-r from-white to-gold bg-clip-text text-transparent font-display text-xl font-bold truncate">Rp <?= number_format((float)($kpis['total_revenue'] ?? 0), 0, ',', '.') ?></div>
        <div class="text-xs text-muted mt-2"><?= __('revenue_this_month') ?>: Rp <?= number_format((float)($kpis['revenue_this_month'] ?? 0), 0, ',', '.') ?></div>
    </div>
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 hover:-translate-y-[3px] hover:border-gold/25 hover:shadow-[0_8px_30px_rgba(0,0,0,0.4)] transition-all duration-300">
        <div class="flex items-center gap-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gold shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
            <span class="text-xs text-muted uppercase tracking-wider font-medium"><?= __('total_profit') ?></span>
        </div>
        <div class="bg-gradient-to-r from-white to-gold bg-clip-text text-transparent font-display text-xl font-bold truncate">Rp <?= number_format((float)($kpis['total_profit'] ?? 0), 0, ',', '.') ?></div>
    </div>
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 hover:-translate-y-[3px] hover:border-gold/25 hover:shadow-[0_8px_30px_rgba(0,0,0,0.4)] transition-all duration-300">
        <div class="flex items-center gap-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gold shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
            <span class="text-xs text-muted uppercase tracking-wider font-medium"><?= __('total_orders') ?></span>
        </div>
        <div class="text-xl font-bold font-display text-text"><?= number_format((int)($kpis['total_orders'] ?? 0)) ?></div>
        <div class="text-xs text-muted mt-2"><?= __('orders_today') ?>: <?= (int)($kpis['orders_today'] ?? 0) ?> &middot; <span class="<?= ($kpis['unpaid_orders'] ?? 0) > 0 ? 'text-danger' : 'text-muted' ?>"><?= __('unpaid_orders') ?>: <?= (int)($kpis['unpaid_orders'] ?? 0) ?></span></div>
    </div>
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-5 hover:-translate-y-[3px] hover:border-gold/25 hover:shadow-[0_8px_30px_rgba(0,0,0,0.4)] transition-all duration-300">
        <div class="flex items-center gap-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gold shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.746 2.148-7.175.012-.643-.51-1.1-1.145-1.1H4.5m5.25 0v-.75a2.25 2.25 0 0 0-2.25-2.25h-.75M6.75 14.25A2.25 2.25 0 1 0 7.5 12"/></svg>
            <span class="text-xs text-muted uppercase tracking-wider font-medium"><?= __('avg_order_value') ?></span>
        </div>
        <div class="text-xl font-bold font-display text-text truncate">Rp <?= number_format((float)($kpis['avg_order_value'] ?? 0), 0, ',', '.') ?></div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 lg:col-span-2">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gold shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                <h2 class="text-base font-bold font-display text-text"><?= __('revenue_trend') ?></h2>
            </div>
            <a href="/reports/revenue" class="text-xs text-gold hover:text-gold/80 transition-colors no-underline"><?= __('revenue_report') ?> &rarr;</a>
        </div>
        <canvas id="revenueChart" height="220" class="w-full"></canvas>
    </div>
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
        <div class="flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gold shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 3H12v7h7V8.25A5.25 5.25 0 0 0 13.5 3Z"/></svg>
            <h2 class="text-base font-bold font-display text-text"><?= __('order_status') ?></h2>
        </div>
        <canvas id="statusChart" height="200" class="w-full"></canvas>
    </div>
</div>

<div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:-translate-y-[3px] hover:border-gold/25 hover:shadow-[0_8px_30px_rgba(0,0,0,0.4)] transition-all duration-300">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gold shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 3H12v7h7V8.25A5.25 5.25 0 0 0 13.5 3Z"/></svg>
            <h2 class="text-base font-bold font-display text-text"><?= __('top_menus') ?></h2>
        </div>
        <a href="/reports/menu-revenue" class="text-xs text-gold hover:text-gold/80 transition-colors no-underline"><?= __('menu_revenue') ?> &rarr;</a>
    </div>
    <?php if (empty($topMenus)): ?>
    <p class="text-sm text-muted"><?= __('no_orders') ?></p>
    <?php else: ?>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-xs text-muted uppercase tracking-wider bg-black/30">
                    <th class="text-left px-5 py-3 font-medium"><?= __('menu') ?></th>
                    <th class="text-right px-5 py-3 font-medium"><?= __('total_qty') ?></th>
                    <th class="text-right px-5 py-3 font-medium"><?= __('revenue') ?></th>
                    <th class="text-right px-5 py-3 font-medium"><?= __('profit') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topMenus as $m): ?>
                <tr class="border-t border-white/5 transition-colors hover:bg-white/[0.03]">
                    <td class="px-5 py-3 text-text font-medium"><?= e($m['name']) ?></td>
                    <td class="px-5 py-3 text-right text-text"><?= (int)$m['total_qty'] ?></td>
                    <td class="px-5 py-3 text-right text-gold">Rp <?= number_format((float)$m['total_revenue'], 0, ',', '.') ?></td>
                    <td class="px-5 py-3 text-right <?= ((float)$m['total_revenue'] - (float)$m['total_cost']) > 0 ? 'text-success' : 'text-danger' ?>">Rp <?= number_format((float)$m['total_revenue'] - (float)$m['total_cost'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script id="dashboard-data" type="application/json"><?= json_encode([
    'chartData' => $chartData,
    'statusBreakdown' => $statusBreakdown,
    'lang' => [
        'revenue' => __('revenue'),
        'profit' => __('profit'),
    ],
], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?></script>
<script src="/assets/js/modules/dashboard-charts.js"></script>
