<?php
declare(strict_types=1);

namespace Database\Migrations;

use App\Core\BaseMigration;

class CreateOrderItemsTable extends BaseMigration {
    protected string $filename = '009_create_order_items_table';

    public function up(): array {
        return [
            "CREATE TABLE IF NOT EXISTS `order_items` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT UNSIGNED NOT NULL,
    `menu_id` INT UNSIGNED NOT NULL,
    `quantity` INT UNSIGNED NOT NULL DEFAULT 1,
    `price_at_time` DECIMAL(12,2) NOT NULL DEFAULT 0,
    `subtotal` DECIMAL(12,2) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_order_items_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
            "INSERT INTO `order_items` (`order_id`, `menu_id`, `quantity`, `price_at_time`, `subtotal`)
SELECT `id`, `menu_id`, `quantity`, ROUND(`total_price` / `quantity`, 2), `total_price`
FROM `orders`
WHERE `menu_id` IS NOT NULL AND `quantity` > 0",
        ];
    }

    public function down(): string {
        return "DROP TABLE IF EXISTS `order_items`";
    }
}
