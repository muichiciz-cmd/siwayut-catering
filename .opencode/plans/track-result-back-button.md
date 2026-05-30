# Plan: track-result.php back button + navbar cleanup

## Changes

### 1. `src/Views/order/track-result.php` — Remove "Cari Lagi" from navbar
**Line 24:** Delete the `<a href="/track-order">` navbar link (`__('search_again')`).

```
-            <a href="/track-order" class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-sm font-medium no-underline bg-white/5 border border-border text-text backdrop-blur-[8px] hover:bg-gold hover:border-gold hover:shadow-[0_0_15px_var(--color-gold-glow)] transition-all duration-300"><?= __('search_again') ?></a>
```

### 2. `src/Views/order/track-result.php` — "Lacak Pesanan Lain" → `history.back()`
**Line 174:** Change from direct link to `history.back()` like admin pages.

Before:
```php
<a href="/track-order" class="block text-center mt-6 text-gold no-underline text-[0.9rem] font-medium transition-all duration-300 hover:[text-shadow:0_0_8px_var(--color-gold-glow)]"><?= __('track_another') ?></a>
```

After:
```php
<a href="javascript:void(0)" onclick="history.back();return false" class="block text-center mt-6 text-gold no-underline text-[0.9rem] font-medium transition-all duration-300 hover:[text-shadow:0_0_8px_var(--color-gold-glow)]"><?= __('track_another') ?></a>
```

## Files affected
- `src/Views/order/track-result.php` only
