<?php
declare(strict_types=1);

namespace Database\Migrations;

use App\Core\BaseMigration;

class DropMenuIdQuantityFromOrders extends BaseMigration {
    protected string $filename = '010_drop_menu_id_quantity_from_orders';

    public function up(): array {
        return [
            "ALTER TABLE `orders` DROP FOREIGN KEY `fk_order_menu`",
            "ALTER TABLE `orders` DROP COLUMN `menu_id`",
            "ALTER TABLE `orders` DROP COLUMN `quantity`",
        ];
    }

    public function down(): array {
        return [
            "ALTER TABLE `orders` ADD COLUMN `menu_id` INT UNSIGNED NOT NULL AFTER `event_id`",
            "ALTER TABLE `orders` ADD COLUMN `quantity` INT UNSIGNED NOT NULL DEFAULT 1 AFTER `event_date`",
            "ALTER TABLE `orders` ADD CONSTRAINT `fk_order_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus`(`id`) ON DELETE RESTRICT",
        ];
    }
}
