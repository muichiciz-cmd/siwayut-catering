<?php
declare(strict_types=1);

namespace Database\Migrations;

use App\Core\BaseMigration;

class AddInvoiceNumberToOrders extends BaseMigration {
    protected string $filename = '017_add_invoice_number_to_orders';

    public function up(): string {
        return "ALTER TABLE `orders`
ADD COLUMN `invoice_number` VARCHAR(50) NULL AFTER `order_number`";
    }

    public function down(): string {
        return "ALTER TABLE `orders` DROP COLUMN `invoice_number`";
    }
}
