<?php
$type = $type ?? 'text';
$value = $value ?? old($name);
$required = $required ?? false;
$placeholder = $placeholder ?? '';
$help_text = $help_text ?? '';
$err = error($name);
$isInvalid = $err ? ' is-invalid' : '';

$accept = $accept ?? 'image/jpeg,image/png,image/webp';
$max_size = $max_size ?? (5 * 1024 * 1024);

$formats = array_map(function ($t) {
    return strtoupper(str_replace('image/', '', trim($t)));
}, explode(',', $accept));
$formatLabel = implode(', ', $formats);
$maxSizeLabel = $max_size >= 1048576
    ? (round($max_size / 1048576, 1) . ' MB')
    : (round($max_size / 1024, 1) . ' KB');

if ($type === 'file' && !$help_text) {
    $help_text = 'Supported: ' . $formatLabel . '. Max ' . $maxSizeLabel . '.';
}
?>
<div class="form-group">
    <label class="form-label" for="<?= e($name) ?>"><?= e($label) ?></label>

    <?php if ($type === 'file'): ?>
    <div class="file-upload-zone<?= $err ? ' has-error' : '' ?>"
         data-accept="<?= e($accept) ?>"
         data-max-size="<?= e($max_size) ?>">
        <input type="file" id="<?= e($name) ?>" name="<?= e($name) ?>"
               class="file-upload-input"
               accept="<?= e($accept) ?>"
               <?= $required ? 'required' : '' ?>>

        <div class="file-upload-placeholder">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
            </svg>
            <p>Drag &amp; drop here, or <span>browse</span></p>
            <small class="file-upload-info"><?= e($formatLabel) ?> &mdash; Max <?= e($maxSizeLabel) ?></small>
        </div>

        <div class="file-upload-preview">
            <img class="file-upload-thumb" src="" alt="Preview">
            <div class="file-upload-details">
                <span class="file-upload-name"></span>
                <div class="file-upload-meta">
                    <span class="file-upload-type"></span>
                    <span class="file-upload-size"></span>
                </div>
            </div>
            <button type="button" class="file-upload-remove btn btn-sm btn-danger">Remove</button>
        </div>

        <div class="file-upload-error"></div>
    </div>

    <?php elseif ($type === 'number'): ?>
    <input type="<?= e($type) ?>" id="<?= e($name) ?>" name="<?= e($name) ?>" class="form-input<?= $isInvalid ?>" value="<?= e($value) ?>" placeholder="<?= e($placeholder) ?>" <?= $required ? 'required' : '' ?> <?= isset($min) ? 'min="'.e($min).'"' : '' ?> <?= isset($step) ? 'step="'.e($step).'"' : '' ?>>

    <?php else: ?>
    <input type="<?= e($type) ?>" id="<?= e($name) ?>" name="<?= e($name) ?>" class="form-input<?= $isInvalid ?>" value="<?= e($value) ?>" placeholder="<?= e($placeholder) ?>" <?= $required ? 'required' : '' ?>>
    <?php endif; ?>

    <?php if ($help_text && $type !== 'file'): ?>
    <small style="color: var(--color-text-muted); font-size: 0.8125rem;"><?= e($help_text) ?></small>
    <?php endif; ?>
    <?php if ($err): ?>
    <div class="form-error"><?= e($err) ?></div>
    <?php endif; ?>
</div>
