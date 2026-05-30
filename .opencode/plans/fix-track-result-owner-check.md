# Plan: Fix OrderController::trackResult() for logged-in customers

## Problem
- `trackResult()` requires `?phone=` query param; `null` causes `preg_replace()` TypeError
- Customers logged in via `/my-orders` link to `/track-order/{order_number}` without phone, so they can't view their own orders

## Changes

### File: `src/Controllers/OrderController.php` — `trackResult()` method

1. **Fix null phone:** `$phone = $request->input('phone') ?? ''` (line 163)
2. **Skip phone verification if owner:** After fetching customer, check if current session user owns this order via `customer.user_id`. If yes, skip the `preg_replace` + phone comparison block. If not, run existing phone verification (anonymous tracking flow).

```php
// Before the existing phone check:
$user = Session::get('user');
$isOwner = $user && $customer && !empty($customer['user_id']) && (int)$customer['user_id'] === (int)$user['id'];
if (!$isOwner) {
    // existing phone verification
}
```

## Files affected
- `src/Controllers/OrderController.php` only (lines ~161-175)
