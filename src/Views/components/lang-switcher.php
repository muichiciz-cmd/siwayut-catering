<?php
$locale = \App\Core\Lang::locale();
?>
<span class="lang-switch" data-locale="<?= $locale ?>">
    <span class="lang-switch-track">
        <span class="lang-switch-slider <?= $locale === 'en' ? 'is-right' : '' ?>"></span>
        <a href="/lang/id" class="lang-switch-opt <?= $locale === 'id' ? 'is-active' : '' ?>" data-lang="id">ID</a>
        <a href="/lang/en" class="lang-switch-opt <?= $locale === 'en' ? 'is-active' : '' ?>" data-lang="en">EN</a>
    </span>
</span>

<style>
.lang-switch {
    display: inline-flex;
    align-items: center;
}
.lang-switch-track {
    position: relative;
    display: flex;
    align-items: center;
    gap: 0;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 9999px;
    padding: 2px;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    width: 80px;
    height: 30px;
}
.lang-switch-slider {
    position: absolute;
    top: 2px;
    left: 2px;
    width: calc(50% - 2px);
    height: calc(100% - 4px);
    background: rgba(229, 142, 38, 0.2);
    border: 1px solid rgba(229, 142, 38, 0.4);
    border-radius: 9999px;
    transition: transform 250ms cubic-bezier(0.34, 1.56, 0.64, 1), background 250ms ease, box-shadow 250ms ease;
    pointer-events: none;
    z-index: 1;
}
.lang-switch-slider.is-right {
    transform: translateX(100%);
    background: rgba(229, 142, 38, 0.25);
    box-shadow: 0 0 12px rgba(229, 142, 38, 0.2);
}
.lang-switch-opt {
    position: relative;
    z-index: 2;
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    font-family: "Outfit", Inter, system-ui, -apple-system, sans-serif;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    text-decoration: none;
    color: rgba(161, 161, 170, 0.6);
    border-radius: 9999px;
    transition: color 200ms ease;
    cursor: pointer;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
}
.lang-switch-opt.is-active {
    color: #e58e26;
}
.lang-switch-opt:not(.is-active):hover {
    color: rgba(161, 161, 170, 0.9);
}
</style>
