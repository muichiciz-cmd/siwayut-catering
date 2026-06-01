<div class="mb-8">
    <div class="flex items-center justify-between mb-1">
        <h1 class="text-2xl font-bold font-display text-text"><?= __('menu_revenue') ?></h1>
        <a href="/dashboard" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg text-sm font-medium no-underline border transition-all duration-200 bg-white/5 border-border text-text hover:bg-white/10 hover:text-text"><?= __('back') ?></a>
    </div>
    <div class="w-[50px] h-[1.5px] bg-gold shadow-[0_0_8px_rgba(229,142,38,0.3)] mt-1"></div>
</div>

<div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="bg-black/30 text-left text-xs font-semibold uppercase tracking-wider text-muted border-b border-border px-5 py-3.5"><?= __('menu') ?></th>
                    <th class="bg-black/30 text-right text-xs font-semibold uppercase tracking-wider text-muted border-b border-border px-5 py-3.5"><?= __('price') ?></th>
                    <th class="bg-black/30 text-right text-xs font-semibold uppercase tracking-wider text-muted border-b border-border px-5 py-3.5"><?= __('cost_price') ?></th>
                    <th class="bg-black/30 text-right text-xs font-semibold uppercase tracking-wider text-muted border-b border-border px-5 py-3.5"><?= __('total_qty') ?></th>
                    <th class="bg-black/30 text-right text-xs font-semibold uppercase tracking-wider text-muted border-b border-border px-5 py-3.5"><?= __('revenue') ?></th>
                    <th class="bg-black/30 text-right text-xs font-semibold uppercase tracking-wider text-muted border-b border-border px-5 py-3.5"><?= __('profit') ?></th>
                    <th class="bg-black/30 text-right text-xs font-semibold uppercase tracking-wider text-muted border-b border-border px-5 py-3.5"><?= __('profit_margin') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($menus)): ?>
                <tr>
                    <td colspan="7" class="px-5 py-10 text-center text-muted text-sm"><?= __('no_orders') ?></td>
                </tr>
                <?php else: ?>
                <?php foreach ($menus as $m): ?>
                <?php $margin = (float)$m['total_revenue'] > 0 ? ((float)$m['total_revenue'] - (float)$m['total_cost']) / (float)$m['total_revenue'] * 100 : 0; ?>
                <tr class="border-b border-white/5 transition-colors hover:bg-white/[0.03]">
                    <td class="px-5 py-3.5 text-sm text-text font-medium"><?= e($m['name']) ?></td>
                    <td class="px-5 py-3.5 text-sm text-gold text-right">Rp <?= number_format((float)$m['price'], 0, ',', '.') ?></td>
                    <td class="px-5 py-3.5 text-sm text-danger text-right">Rp <?= number_format((float)$m['cost_price'], 0, ',', '.') ?></td>
                    <td class="px-5 py-3.5 text-sm text-text text-right"><?= (int)$m['total_qty'] ?></td>
                    <td class="px-5 py-3.5 text-sm text-gold text-right font-medium">Rp <?= number_format((float)$m['total_revenue'], 0, ',', '.') ?></td>
                    <td class="px-5 py-3.5 text-sm text-right font-medium <?= ((float)$m['total_revenue'] - (float)$m['total_cost']) > 0 ? 'text-success' : 'text-danger' ?>">Rp <?= number_format((float)$m['total_revenue'] - (float)$m['total_cost'], 0, ',', '.') ?></td>
                    <td class="px-5 py-3.5 text-sm text-right <?= $margin >= 0 ? 'text-success' : 'text-danger' ?>"><?= number_format($margin, 1) ?>%</td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
