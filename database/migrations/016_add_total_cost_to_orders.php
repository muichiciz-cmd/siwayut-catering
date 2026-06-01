<?php
declare(strict_types=1);

namespace Database\Migrations;

use App\Core\BaseMigration;

class AddTotalCostToOrders extends BaseMigration {
    protected string $filename = '016_add_total_cost_to_orders';

    public function up(): string {
        return "ALTER TABLE `orders`
ADD COLUMN `total_cost` DECIMAL(12,2) NOT NULL DEFAULT 0 AFTER `total_price`";
    }

    public function down(): string {
        return "ALTER TABLE `orders` DROP COLUMN `total_cost`";
    }
}
