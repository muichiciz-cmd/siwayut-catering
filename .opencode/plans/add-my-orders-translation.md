# Plan: Add missing `my_orders` translation key

## Problem
`my_orders` key is used in 3 places but missing from both lang files → shows raw `my_orders` on page.

## Changes

### `lang/id.php` (after line 4 `'orders'`)
```php
'my_orders' => 'Pesanan Saya',
```

### `lang/en.php` (after line 4 `'orders'`)
```php
'my_orders' => 'My Orders',
```

## Files affected
- `lang/id.php`
- `lang/en.php`
