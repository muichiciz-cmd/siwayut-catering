<?php
declare(strict_types=1);

namespace Database\Migrations;

use App\Core\BaseMigration;

class AddCostPriceToOrderItems extends BaseMigration {
    protected string $filename = '015_add_cost_price_to_order_items';

    public function up(): string {
        return "ALTER TABLE `order_items`
ADD COLUMN `cost_price_at_time` DECIMAL(12,2) NOT NULL DEFAULT 0 AFTER `price_at_time`";
    }

    public function down(): string {
        return "ALTER TABLE `order_items` DROP COLUMN `cost_price_at_time`";
    }
}
