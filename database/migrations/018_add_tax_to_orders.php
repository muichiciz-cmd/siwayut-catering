<?php
declare(strict_types=1);

namespace Database\Migrations;

use App\Core\BaseMigration;

class AddTaxToOrders extends BaseMigration {
    protected string $filename = '018_add_tax_to_orders';

    public function up(): string {
        return "ALTER TABLE `orders`
ADD COLUMN `tax_rate` DECIMAL(5,2) NOT NULL DEFAULT 0 AFTER `total_cost`,
ADD COLUMN `tax_amount` DECIMAL(12,2) NOT NULL DEFAULT 0 AFTER `tax_rate`,
ADD COLUMN `grand_total` DECIMAL(12,2) NOT NULL DEFAULT 0 AFTER `tax_amount`";
    }

    public function down(): string {
        return "ALTER TABLE `orders`
DROP COLUMN `grand_total`,
DROP COLUMN `tax_amount`,
DROP COLUMN `tax_rate`";
    }
}
