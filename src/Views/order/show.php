<div class="max-w-[960px] mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h1 class="text-2xl font-bold font-display text-text">Order <span class="text-gold">#<?= (int)$order['id'] ?></span></h1>
            <p class="text-sm text-muted mt-1"><?= date('d F Y, H:i', strtotime($order['created_at'])) ?></p>
        </div>
        <a href="/orders" class="inline-flex items-center justify-center gap-2 px-5 py-2 rounded-full text-sm font-medium leading-tight cursor-pointer border transition-all duration-150 no-underline whitespace-nowrap font-body hover:translate-y-[-1px] hover:shadow-md active:translate-y-0 bg-white/5 border-border text-text backdrop-blur-[8px] hover:bg-gold hover:border-gold hover:shadow-[0_0_15px_var(--color-gold-glow)] hover:text-white">&larr; Back</a>
    </div>

    <div class="flex flex-col gap-6">
        <!-- Order Header Card -->
        <div class="bg-card-bg border border-border backdrop-blur-[16px] rounded-xl p-6">
            <div class="flex items-start justify-between flex-wrap gap-4">
                <div class="flex items-center gap-4 flex-wrap">
                    <span class="inline-flex items-center px-4 py-[0.35rem] rounded-full text-[0.8rem] font-semibold uppercase tracking-wide order-status-badge"
                        style="background:<?php
                            $sc = ['pending'=>'rgba(245,158,11,0.15)','processing'=>'rgba(79,70,229,0.15)','delivering'=>'rgba(79,70,229,0.15)','completed'=>'rgba(16,185,129,0.15)','cancelled'=>'rgba(239,68,68,0.15)'];
                            echo $sc[$order['status']] ?? 'rgba(161,161,170,0.15)';
                        ?>;color:<?php
                            $st = ['pending'=>'#f59e0b','processing'=>'#4f46e5','delivering'=>'#4f46e5','completed'=>'#10b981','cancelled'=>'#ef4444'];
                            echo $st[$order['status']] ?? '#a1a1aa';
                        ?>;border-color:<?php
                            $sb = ['pending'=>'rgba(245,158,11,0.3)','processing'=>'rgba(79,70,229,0.3)','delivering'=>'rgba(79,70,229,0.3)','completed'=>'rgba(16,185,129,0.3)','cancelled'=>'rgba(239,68,68,0.3)'];
                            echo $sb[$order['status']] ?? 'rgba(161,161,170,0.3)';
                        ?>"
                        data-status="<?= e($order['status']) ?>">
                        <?= e(ucfirst($order['status'])) ?>
                    </span>
                    <span class="inline-flex items-center px-4 py-[0.35rem] rounded-full text-[0.8rem] font-semibold uppercase tracking-wide payment-status-badge"
                        style="background:<?php
                            $pc = ['unpaid'=>'rgba(245,158,11,0.15)','paid'=>'rgba(16,185,129,0.15)','refunded'=>'rgba(239,68,68,0.15)'];
                            echo $pc[$order['payment_status']] ?? 'rgba(161,161,170,0.15)';
                        ?>;color:<?php
                            $pt = ['unpaid'=>'#f59e0b','paid'=>'#10b981','refunded'=>'#ef4444'];
                            echo $pt[$order['payment_status']] ?? '#a1a1aa';
                        ?>;border-color:<?php
                            $pb = ['unpaid'=>'rgba(245,158,11,0.3)','paid'=>'rgba(16,185,129,0.3)','refunded'=>'rgba(239,68,68,0.3)'];
                            echo $pb[$order['payment_status']] ?? 'rgba(161,161,170,0.3)';
                        ?>"
                        data-payment="<?= e($order['payment_status']) ?>">
                        <?= e(ucfirst($order['payment_status'])) ?>
                    </span>
                </div>
                <div class="text-right">
                    <div class="text-xs text-muted uppercase tracking-wide font-medium mb-1">Total</div>
                    <div class="font-display text-2xl font-bold text-gold" id="order-total">Rp <?= number_format((float)$order['total_price'], 0, ',', '.') ?></div>
                </div>
            </div>
        </div>

        <!-- Two-column: Timeline + Details -->
        <div class="grid grid-cols-1 md:grid-cols-[1fr_1.5fr] gap-6">
            <!-- Left: Status Timeline -->
            <div class="bg-card-bg border border-border backdrop-blur-[16px] rounded-xl p-6">
                <h4 class="font-display font-semibold text-text mb-5 pb-3 border-b border-border flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gold"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"/></svg>
                    Order Progress
                </h4>
                <div class="flex flex-col gap-4" id="status-timeline">
                    <?php
                    $statuses = [
                        'pending' => ['label' => 'Order Received', 'desc' => 'Your order is being reviewed'],
                        'processing' => ['label' => 'Processing', 'desc' => 'We are preparing your order'],
                        'delivering' => ['label' => 'Delivering', 'desc' => 'Your order is on its way'],
                        'completed' => ['label' => 'Completed', 'desc' => 'Your order has arrived'],
                    ];
                    $orderStatus = $order['status'];
                    foreach ($statuses as $key => $step):
                        $isActive = in_array($orderStatus, ['pending', 'processing', 'delivering', 'completed']) && (
                            ($key === 'pending') ||
                            ($key === 'processing' && in_array($orderStatus, ['processing', 'delivering', 'completed'])) ||
                            ($key === 'delivering' && in_array($orderStatus, ['delivering', 'completed'])) ||
                            ($key === 'completed' && $orderStatus === 'completed')
                        );
                        if ($orderStatus === 'cancelled') $isActive = $key === 'pending';
                    ?>
                    <div class="flex gap-4 items-start status-step" data-step="<?= e($key) ?>" data-active="<?= $isActive ? '1' : '0' ?>">
                        <div class="w-3 h-3 rounded-full mt-1.5 shrink-0 status-dot transition-all duration-300 <?= $isActive ? 'bg-gold shadow-[0_0_8px_var(--color-gold-glow)]' : 'bg-white/10' ?>"></div>
                        <div>
                            <div class="font-semibold text-[0.9rem] transition-colors duration-300 <?= $isActive ? 'text-text' : 'text-muted' ?>"><?= e($step['label']) ?></div>
                            <div class="text-[0.8rem] text-muted"><?= e($step['desc']) ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php if ($orderStatus === 'cancelled'): ?>
                    <div class="flex gap-4 items-start status-step" data-step="cancelled" data-active="1">
                        <div class="w-3 h-3 rounded-full mt-1.5 shrink-0 bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.3)]"></div>
                        <div>
                            <div class="font-semibold text-[0.9rem] text-[#ef4444]">Cancelled</div>
                            <div class="text-[0.8rem] text-muted">Order has been cancelled</div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Edit Status Toggle -->
                <button type="button" id="toggle-edit-status" class="mt-6 w-full inline-flex items-center justify-center gap-2 px-4 py-2 rounded-full text-sm font-medium leading-tight cursor-pointer border transition-all duration-150 no-underline whitespace-nowrap font-body hover:translate-y-[-1px] hover:shadow-md active:translate-y-0 bg-white/5 border-border text-text backdrop-blur-[8px] hover:bg-gold hover:border-gold hover:shadow-[0_0_15px_var(--color-gold-glow)] hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/></svg>
                    Update Status
                </button>

                <form id="status-form" action="/orders/<?= (int)$order['id'] ?>" method="POST" class="hidden mt-4 pt-4 border-t border-border">
                    <?= csrf_field() ?>
                    <div class="flex flex-col gap-3">
                        <select name="status" class="w-full px-3 py-2 border border-border rounded-lg text-sm text-text bg-black/40 font-body focus:outline-none focus:border-primary focus:ring-3 focus:ring-primary-light">
                            <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                            <option value="delivering" <?= $order['status'] === 'delivering' ? 'selected' : '' ?>>Delivering</option>
                            <option value="completed" <?= $order['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                            <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                        <select name="payment_status" class="w-full px-3 py-2 border border-border rounded-lg text-sm text-text bg-black/40 font-body focus:outline-none focus:border-primary focus:ring-3 focus:ring-primary-light">
                            <option value="unpaid" <?= $order['payment_status'] === 'unpaid' ? 'selected' : '' ?>>Unpaid</option>
                            <option value="paid" <?= $order['payment_status'] === 'paid' ? 'selected' : '' ?>>Paid</option>
                            <option value="refunded" <?= $order['payment_status'] === 'refunded' ? 'selected' : '' ?>>Refunded</option>
                        </select>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-full text-sm font-medium leading-tight cursor-pointer border transition-all duration-150 no-underline whitespace-nowrap font-body hover:translate-y-[-1px] hover:shadow-md active:translate-y-0 bg-primary text-white border-primary hover:bg-primary-hover hover:border-primary-hover hover:shadow-[0_0_15px_var(--color-gold-glow)] hover:text-white">Save</button>
                    </div>
                </form>
            </div>

            <!-- Right: Order Details + Items -->
            <div class="flex flex-col gap-6">
                <!-- Customer Details -->
                <div class="bg-card-bg border border-border backdrop-blur-[16px] rounded-xl p-6">
                    <h4 class="font-display font-semibold text-text mb-4 pb-3 border-b border-border">Customer</h4>
                    <div class="grid grid-cols-[120px_1fr] max-md:grid-cols-1 gap-y-3 gap-x-3 text-sm">
                        <div class="text-muted">Name</div>
                        <div class="text-text font-medium"><?= e($customer['name'] ?? '-') ?></div>
                        <div class="text-muted">Phone</div>
                        <div class="text-text">
                            <?php if ($customer['phone'] ?? null): ?>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $customer['phone']) ?>" target="_blank" class="text-gold hover:text-gold no-underline inline-flex items-center gap-1"><?= e($customer['phone']) ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            </a>
                            <?php else: ?>-<?php endif; ?>
                        </div>
                        <div class="text-muted">Event Date</div>
                        <div class="text-text"><?= date('d F Y, H:i', strtotime($order['event_date'])) ?></div>
                        <div class="text-muted">Address</div>
                        <div class="text-text"><?= nl2br(e($order['delivery_address'])) ?></div>
                        <?php if ($order['notes']): ?>
                        <div class="text-muted">Notes</div>
                        <div class="text-text text-muted italic"><?= nl2br(e($order['notes'])) ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Menu Items -->
                <div class="bg-card-bg border border-border backdrop-blur-[16px] rounded-xl overflow-hidden">
                    <div class="p-6 pb-4">
                        <h4 class="font-display font-semibold text-text flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gold"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/></svg>
                            Menu Items
                        </h4>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-black/30">
                                    <th class="text-left text-xs font-semibold uppercase tracking-wider text-muted px-4 py-2.5 border-b border-border">Menu</th>
                                    <th class="text-right text-xs font-semibold uppercase tracking-wider text-muted px-4 py-2.5 border-b border-border">Qty</th>
                                    <th class="text-right text-xs font-semibold uppercase tracking-wider text-muted px-4 py-2.5 border-b border-border">Price</th>
                                    <th class="text-right text-xs font-semibold uppercase tracking-wider text-muted px-4 py-2.5 border-b border-border">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; foreach ($items as $item): $total += (float)$item['subtotal']; ?>
                                <tr class="border-b border-white/[0.06] hover:bg-white/[0.02]">
                                    <td class="px-4 py-3 text-sm text-text"><?= e($item['menu_name']) ?></td>
                                    <td class="px-4 py-3 text-sm text-text text-right"><?= (int)$item['quantity'] ?>x</td>
                                    <td class="px-4 py-3 text-sm text-text text-right">Rp <?= number_format((float)$item['price_at_time'], 0, ',', '.') ?></td>
                                    <td class="px-4 py-3 text-sm text-text text-right font-medium">Rp <?= number_format((float)$item['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-black/20">
                                    <td colspan="3" class="px-4 py-3 text-sm font-semibold text-text text-right">Total</td>
                                    <td class="px-4 py-3 text-sm font-bold text-gold text-right" id="items-total">Rp <?= number_format($total, 0, ',', '.') ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';

    // Toggle status edit form
    var toggleBtn = document.getElementById('toggle-edit-status');
    var statusForm = document.getElementById('status-form');
    if (toggleBtn && statusForm) {
        toggleBtn.addEventListener('click', function() {
            statusForm.classList.toggle('hidden');
        });
    }

    // AJAX status update
    if (statusForm) {
        statusForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var form = e.target;
            var btn = form.querySelector('button[type="submit"]');
            var origText = btn.textContent;
            btn.disabled = true;
            btn.innerHTML = '<span class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin inline-block"></span> Saving...';

            fetch(form.action, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                body: new FormData(form)
            })
            .then(function(r) { return r.json(); })
            .then(function(resp) {
                if (resp.success) {
                    // Reload page to show updated status
                    window.location.reload();
                } else {
                    if (window.AppModules && window.AppModules.toast) {
                        window.AppModules.toast.show(resp.error || 'Update failed.', 'error');
                    }
                    btn.disabled = false;
                    btn.textContent = origText;
                }
            })
            .catch(function() {
                if (window.AppModules && window.AppModules.toast) {
                    window.AppModules.toast.show('Network error.', 'error');
                }
                btn.disabled = false;
                btn.textContent = origText;
            });
        });
    }

    // Price counter animation
    var totalEl = document.getElementById('order-total');
    if (totalEl) {
        var target = parseFloat(totalEl.textContent.replace(/[^0-9]/g, ''));
        if (target > 0) {
            var duration = 600;
            var startTime = null;
            function animate(time) {
                if (!startTime) startTime = time;
                var elapsed = time - startTime;
                var progress = Math.min(elapsed / duration, 1);
                // ease-out quad
                var eased = 1 - (1 - progress) * (1 - progress);
                var current = Math.floor(eased * target);
                totalEl.textContent = 'Rp ' + current.toLocaleString('id-ID');
                if (progress < 1) requestAnimationFrame(animate);
            }
            totalEl.textContent = 'Rp 0';
            requestAnimationFrame(animate);
        }
    }
})();
</script>
