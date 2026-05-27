-- File: database/migrations/005_add_payment_status_to_orders.sql
ALTER TABLE `orders`
ADD COLUMN `payment_status` ENUM('unpaid', 'paid', 'refunded')
NOT NULL DEFAULT 'unpaid' AFTER `status`;
