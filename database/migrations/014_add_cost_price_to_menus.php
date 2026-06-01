<?php
declare(strict_types=1);

namespace Database\Migrations;

use App\Core\BaseMigration;

class AddCostPriceToMenus extends BaseMigration {
    protected string $filename = '014_add_cost_price_to_menus';

    public function up(): string {
        return "ALTER TABLE `menus`
ADD COLUMN `cost_price` DECIMAL(12,2) NOT NULL DEFAULT 0 AFTER `price`";
    }

    public function down(): string {
        return "ALTER TABLE `menus` DROP COLUMN `cost_price`";
    }
}
