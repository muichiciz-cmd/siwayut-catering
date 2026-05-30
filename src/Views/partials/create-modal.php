<?php
$createModalId = $createModalId ?? '';
$createTitle = $createTitle ?? 'Add';
$createAction = $createAction ?? '';
$createSubmitText = $createSubmitText ?? 'Save';
$createEnctype = $createEnctype ?? 'application/x-www-form-urlencoded';
if (!$createModalId) return;
?>
<div id="<?= e($createModalId) ?>" class="hidden fixed inset-0 z-50 overflow-y-auto" style="background:rgba(0,0,0,0.6);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px)">
    <div class="flex min-h-full items-center justify-center p-4" style="pointer-events:none">
    <div class="bg-[#18181b] border border-white/10 rounded-2xl shadow-2xl w-full max-w-[1200px] mx-auto max-h-[90vh] flex flex-col overflow-hidden" style="pointer-events:auto;transform:scale(0.95) translateY(10px);opacity:0;transition:transform 200ms cubic-bezier(0.16,1,0.3,1),opacity 200ms ease-out">
        <div class="flex items-center justify-between p-6 border-b border-white/10 shrink-0">
            <h3 class="text-lg font-bold font-display text-white"><?= e($createTitle) ?></h3>
            <button type="button" onclick="closeCreateModal('<?= e($createModalId) ?>')" class="w-8 h-8 flex items-center justify-center rounded-lg text-muted hover:text-text hover:bg-white/5 transition-all duration-150 cursor-pointer border-0 bg-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="<?= e($createModalId) ?>-form" method="POST" action="<?= e($createAction) ?>" enctype="<?= e($createEnctype) ?>" class="flex flex-col flex-1 min-h-0">
            <?= \App\Core\Csrf::field() ?>
            <div id="<?= e($createModalId) ?>-errors" class="hidden p-4 mx-6 mt-4 rounded-lg bg-danger/10 border border-danger/30 text-danger text-sm shrink-0"></div>
            <div class="p-6 space-y-4 overflow-y-auto flex-1 min-h-0">
                <?= $createFormContent ?? '' ?>
            </div>
            <div class="flex items-center justify-end gap-3 p-6 border-t border-white/10 shrink-0">
                <button type="button" onclick="closeCreateModal('<?= e($createModalId) ?>')" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg text-sm font-medium leading-tight cursor-pointer border transition-all duration-150 no-underline whitespace-nowrap font-body bg-white/6 text-text border-border hover:bg-white/10 hover:text-text"><?= __('cancel') ?></button>
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg text-sm font-medium leading-tight cursor-pointer border transition-all duration-150 no-underline whitespace-nowrap font-body hover:translate-y-[-1px] hover:shadow-md active:translate-y-0 bg-primary text-white border-primary hover:bg-primary-hover hover:border-primary-hover hover:shadow-[0_0_15px_var(--color-gold-glow)] hover:text-white"><?= e($createSubmitText) ?></button>
            </div>
        </form>
    </div>
    </div>
</div>
