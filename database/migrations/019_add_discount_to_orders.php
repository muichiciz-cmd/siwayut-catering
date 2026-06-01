<?php
declare(strict_types=1);

namespace Database\Migrations;

use App\Core\BaseMigration;

class AddDiscountToOrders extends BaseMigration {
    protected string $filename = '019_add_discount_to_orders';

    public function up(): string {
        return "ALTER TABLE `orders`
ADD COLUMN `discount_type` ENUM('none','percentage','fixed') NOT NULL DEFAULT 'none' AFTER `grand_total`,
ADD COLUMN `discount_value` DECIMAL(12,2) NOT NULL DEFAULT 0 AFTER `discount_type`,
ADD COLUMN `discount_amount` DECIMAL(12,2) NOT NULL DEFAULT 0 AFTER `discount_value`";
    }

    public function down(): string {
        return "ALTER TABLE `orders`
DROP COLUMN `discount_amount`,
DROP COLUMN `discount_value`,
DROP COLUMN `discount_type`";
    }
}
