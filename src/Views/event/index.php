<?php $headerTitle = $title; $createModal = 'createEventModal'; ?>
<?php require __DIR__ . '/../partials/table-header.php' ?>
<?php
$searchPlaceholder = __('search_event');
$search = $search ?? '';
$filters = [
    [
        'label' => __('status'),
        'name' => 'status',
        'options' => ['' => __('all_statuses'), 'active' => __('active'), 'inactive' => __('inactive')],
        'selected' => $filters['status'] ?? '',
    ],
];
?>
<?php require __DIR__ . '/../partials/table-search.php' ?>
<div id="table-container" class="bg-[#18181b] border border-border rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr>
<?php require __DIR__ . '/../partials/table-sort.php' ?>
                    <th class="bg-black/30 text-left text-xs font-semibold uppercase tracking-wider text-muted border-b border-border"><a href="<?= $sortUrl('id') ?>" class="flex items-center gap-1 px-4 py-3 group text-muted hover:text-gold transition-colors no-underline">ID<?= $sortIcon('id') ?></a></th>
                    <th class="bg-black/30 text-left text-xs font-semibold uppercase tracking-wider text-muted border-b border-border"><a href="<?= $sortUrl('name') ?>" class="flex items-center gap-1 px-4 py-3 group text-muted hover:text-gold transition-colors no-underline"><?= __('name') ?><?= $sortIcon('name') ?></a></th>
                    <th class="bg-black/30 text-left text-xs font-semibold uppercase tracking-wider text-muted border-b border-border"><a href="<?= $sortUrl('start_date') ?>" class="flex items-center gap-1 px-4 py-3 group text-muted hover:text-gold transition-colors no-underline"><?= __('duration') ?><?= $sortIcon('start_date') ?></a></th>
                    <th class="bg-black/30 text-left text-xs font-semibold uppercase tracking-wider text-muted border-b border-border"><a href="<?= $sortUrl('status') ?>" class="flex items-center gap-1 px-4 py-3 group text-muted hover:text-gold transition-colors no-underline"><?= __('status') ?><?= $sortIcon('status') ?></a></th>
                    <th class="bg-black/30 text-left text-xs font-semibold uppercase tracking-wider text-muted border-b border-border"><a href="<?= $sortUrl('menu_count') ?>" class="flex items-center gap-1 px-4 py-3 group text-muted hover:text-gold transition-colors no-underline"><?= __('menus') ?><?= $sortIcon('menu_count') ?></a></th>
                    <th class="bg-black/30 px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-muted border-b border-border"><?= __('actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($events)): ?>
                    <tr>
                        <td colspan="6" class="px-4 py-3.5 text-sm border-b border-white/[0.06] align-middle text-text text-center p-8"><?= __('no_events') ?></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                        <tr class="cursor-pointer hover:bg-white/[0.03]" onclick="if(!event.target.closest('a,button,form')) location.href='/menus?event_id=<?= e($event['id']) ?>'">
                            <td class="px-4 py-3.5 text-sm border-b border-white/[0.06] align-middle text-text"><?= e($event['id']) ?></td>
                            <td class="px-4 py-3.5 text-sm border-b border-white/[0.06] align-middle text-text"><?= e($event['name']) ?></td>
                            <td class="px-4 py-3.5 text-sm border-b border-white/[0.06] align-middle text-text">
                                <?= e(date('d M Y', strtotime($event['start_date']))) ?> - 
                                <?= e(date('d M Y', strtotime($event['end_date']))) ?>
                            </td>
                            <td class="px-4 py-3.5 text-sm border-b border-white/[0.06] align-middle text-text">
                                <?php if ($event['status'] === 'active'): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[var(--color-success)] text-white"><?= __('active') ?></span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[var(--text-muted)] text-white"><?= __('inactive') ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3.5 text-sm border-b border-white/[0.06] align-middle text-text"><?= (int)$event['menu_count'] ?></td>
                            <td class="px-4 py-3.5 text-sm border-b border-white/[0.06] align-middle text-text">
                                <div class="flex gap-2">
                                    <a href="#" data-edit="events" data-id="<?= e($event['id']) ?>" class="inline-flex items-center justify-center gap-2 px-3 py-1.5 text-[0.8125rem] rounded-lg text-sm font-medium leading-tight cursor-pointer border transition-all duration-150 no-underline whitespace-nowrap font-body hover:translate-y-[-1px] hover:shadow-md active:translate-y-0 bg-white/6 text-text border-border hover:bg-white/10 hover:text-text"><?= __('edit') ?></a>
                                    <form method="POST" action="/events/<?= e($event['id']) ?>/delete" class="inline">
                                        <?= \App\Core\Csrf::field() ?>
                                        <button type="submit" data-modal-confirm="<?= __('confirm_delete_event') ?>" class="inline-flex items-center justify-center gap-2 px-3 py-1.5 text-[0.8125rem] rounded-lg text-sm font-medium leading-tight cursor-pointer border transition-all duration-150 no-underline whitespace-nowrap font-body hover:translate-y-[-1px] hover:shadow-md active:translate-y-0 bg-danger text-white border-danger hover:bg-danger-hover hover:border-danger-hover hover:text-white"><?= __('delete') ?></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php $paginationCompact = true; require __DIR__ . '/../partials/table-pagination.php' ?>
    </div>
</div>
<?php
$createModalId = 'createEventModal';
$createTitle = __('add_event');
$createAction = '/events';
$createSubmitText = __('save_event');
ob_start();
component('form/input', ['name' => 'name', 'label' => __('event_name_help'), 'required' => true]);
echo '<div class="grid grid-cols-2 gap-4">';
component('form/input', ['name' => 'start_date', 'label' => __('start_date'), 'type' => 'date', 'required' => true]);
component('form/input', ['name' => 'end_date', 'label' => __('end_date'), 'type' => 'date', 'required' => true]);
echo '</div>';
component('form/select', ['name' => 'status', 'label' => __('status'), 'options' => ['active' => __('active'), 'inactive' => __('inactive')], 'required' => true]);
$createFormContent = ob_get_clean();
require __DIR__ . '/../partials/create-modal.php';
?>
