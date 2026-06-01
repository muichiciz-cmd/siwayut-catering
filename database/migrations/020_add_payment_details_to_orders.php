<?php
declare(strict_types=1);

namespace Database\Migrations;

use App\Core\BaseMigration;

class AddPaymentDetailsToOrders extends BaseMigration {
    protected string $filename = '020_add_payment_details_to_orders';

    public function up(): string {
        return "ALTER TABLE `orders`
ADD COLUMN `payment_method` ENUM('cash','transfer','qris','other') NOT NULL DEFAULT 'cash' AFTER `payment_status`,
ADD COLUMN `paid_at` DATETIME NULL AFTER `payment_method`";
    }

    public function down(): string {
        return "ALTER TABLE `orders`
DROP COLUMN `paid_at`,
DROP COLUMN `payment_method`";
    }
}
