<?php
$currentLocale = $_SESSION['locale'] ?? 'id';
$locales = [
    'id' => ['label' => 'ID', 'flag' => '🇮🇩'],
    'en' => ['label' => 'EN', 'flag' => '🇬🇧'],
];
?>
<div class="lang-switcher relative flex items-center gap-1">
    <?php foreach ($locales as $code => $locale): ?>
        <?php if ($code === $currentLocale): ?>
            <span class="lang-btn active inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-gold/20 border border-gold/40 text-gold cursor-default select-none">
                <?= $locale['flag'] ?> <?= $locale['label'] ?>
            </span>
        <?php else: ?>
            <a href="/lang/<?= htmlspecialchars($code) ?>"
               class="lang-btn inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-white/5 border border-border text-muted hover:border-gold/40 hover:text-gold hover:bg-gold/10 transition-all duration-200 no-underline">
                <?= $locale['flag'] ?> <?= $locale['label'] ?>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
