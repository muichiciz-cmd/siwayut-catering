<div class="mb-8">
    <div class="flex items-center justify-between mb-1">
        <h1 class="text-2xl font-bold font-display text-text"><?= __('revenue_report') ?></h1>
        <a href="/dashboard" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg text-sm font-medium no-underline border transition-all duration-200 bg-white/5 border-border text-text hover:bg-white/10 hover:text-text"><?= __('back') ?></a>
    </div>
    <div class="w-[50px] h-[1.5px] bg-gold shadow-[0_0_8px_rgba(229,142,38,0.3)] mt-1"></div>
</div>

<div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-6">
    <form method="GET" class="flex items-end gap-3">
        <div>
            <label class="block text-xs font-medium text-muted mb-1.5"><?= __('date_from') ?></label>
            <input type="date" name="date_from" value="<?= e($dateFrom) ?>" class="px-3 py-2 border border-border rounded-lg text-sm text-text bg-black/40 font-body focus:outline-none focus:border-primary focus:ring-3 focus:ring-primary-light transition-all duration-200">
        </div>
        <div>
            <label class="block text-xs font-medium text-muted mb-1.5"><?= __('date_to') ?></label>
            <input type="date" name="date_to" value="<?= e($dateTo) ?>" class="px-3 py-2 border border-border rounded-lg text-sm text-text bg-black/40 font-body focus:outline-none focus:border-primary focus:ring-3 focus:ring-primary-light transition-all duration-200">
        </div>
        <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-2 rounded-lg text-sm font-medium no-underline border transition-all duration-200 bg-gold/10 border-gold/20 text-gold hover:bg-gold/20 hover:border-gold/30"><?= __('apply_filter') ?></button>
    </form>
</div>

<div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="bg-black/30 text-left text-xs font-semibold uppercase tracking-wider text-muted border-b border-border px-5 py-3.5"><?= __('date') ?></th>
                    <th class="bg-black/30 text-right text-xs font-semibold uppercase tracking-wider text-muted border-b border-border px-5 py-3.5"><?= __('total_orders') ?></th>
                    <th class="bg-black/30 text-right text-xs font-semibold uppercase tracking-wider text-muted border-b border-border px-5 py-3.5"><?= __('revenue') ?></th>
                    <th class="bg-black/30 text-right text-xs font-semibold uppercase tracking-wider text-muted border-b border-border px-5 py-3.5"><?= __('profit') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rows)): ?>
                <tr>
                    <td colspan="4" class="px-5 py-10 text-center text-muted text-sm"><?= __('no_orders') ?></td>
                </tr>
                <?php else: ?>
                <?php foreach ($rows as $row): ?>
                <tr class="border-b border-white/5 transition-colors hover:bg-white/[0.03]">
                    <td class="px-5 py-3.5 text-sm text-text"><?= e($row['date']) ?></td>
                    <td class="px-5 py-3.5 text-sm text-text text-right"><?= (int)$row['orders'] ?></td>
                    <td class="px-5 py-3.5 text-sm text-gold text-right font-medium">Rp <?= number_format((float)$row['revenue'], 0, ',', '.') ?></td>
                    <td class="px-5 py-3.5 text-sm text-right font-medium <?= (float)$row['profit'] > 0 ? 'text-success' : 'text-danger' ?>">Rp <?= number_format((float)$row['profit'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="bg-gold/5 font-bold border-t-2 border-gold/20">
                    <td class="px-5 py-3.5 text-sm text-text"><?= __('total') ?></td>
                    <td class="px-5 py-3.5 text-sm text-text text-right"><?= (int)($totals['orders'] ?? 0) ?></td>
                    <td class="bg-gradient-to-r from-white to-gold bg-clip-text text-transparent font-display px-5 py-3.5 text-sm text-right">Rp <?= number_format((float)($totals['revenue'] ?? 0), 0, ',', '.') ?></td>
                    <td class="px-5 py-3.5 text-sm text-right <?= ($totals['profit'] ?? 0) > 0 ? 'text-success' : 'text-danger' ?>">Rp <?= number_format((float)($totals['profit'] ?? 0), 0, ',', '.') ?></td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
