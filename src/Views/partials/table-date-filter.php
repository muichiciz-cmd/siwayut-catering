<div class="bg-[#111113] border border-white/5 rounded-xl p-4 mb-6">
    <form method="GET" class="flex flex-wrap items-end gap-3">
        <?php foreach (['sort_by', 'dir', 'page'] as $__key): ?>
            <?php if (!empty($_GET[$__key])): ?>
                <input type="hidden" name="<?= e($__key) ?>" value="<?= e((string)$_GET[$__key]) ?>">
            <?php endif; ?>
        <?php endforeach; ?>
        <div>
            <label class="block text-[11px] font-medium text-muted mb-1"><?= __('date_from') ?></label>
            <input type="date" name="date_from" value="<?= e($dateFrom ?? date('Y-m-01')) ?>"
                class="px-3 py-1.5 text-sm bg-black/40 border border-white/10 rounded-lg text-white placeholder:text-muted focus:outline-none focus:border-gold/50 transition-colors">
        </div>
        <div>
            <label class="block text-[11px] font-medium text-muted mb-1"><?= __('date_to') ?></label>
            <input type="date" name="date_to" value="<?= e($dateTo ?? date('Y-m-t')) ?>"
                class="px-3 py-1.5 text-sm bg-black/40 border border-white/10 rounded-lg text-white placeholder:text-muted focus:outline-none focus:border-gold/50 transition-colors">
        </div>
        <button type="submit"
            class="px-4 py-1.5 text-sm font-medium bg-gold/10 border border-gold/20 text-gold rounded-lg hover:bg-gold/20 transition-colors"><?= __('apply_filter') ?></button>
    </form>
</div>
