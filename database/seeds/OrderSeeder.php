<?php
declare(strict_types=1);
// File: database/seeds/OrderSeeder.php

namespace Database\Seeds;

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__, 2));
}

require BASE_PATH . '/vendor/autoload.php';

if (file_exists(BASE_PATH . '/.env')) {
    $env = parse_ini_file(BASE_PATH . '/.env');
    if ($env !== false) {
        foreach ($env as $key => $value) {
            $_ENV[$key] = $value;
        }
    }
}

if (!defined('APP_NAME')) {
    require BASE_PATH . '/config/app.php';
}

use App\Core\Database;

class OrderSeeder {
    public static function run(): void {
        $db = Database::getInstance();

        // 1. Fetch available events and menus
        $events = $db->query("SELECT id FROM events")->fetchAll(\PDO::FETCH_COLUMN);
        $menus = $db->query("SELECT id, price FROM menus")->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($events) || empty($menus)) {
            echo "Error: Events or Menus table is empty. Please run MenuSeeder first.\n";
            return;
        }

        // 2. Create Dummy Customers
        $customers = [
            [
                'name' => 'Budi Santoso',
                'phone' => '081234567890',
                'email' => 'budi.santoso@example.com',
                'address' => 'Jl. Merdeka No. 10, Jakarta',
                'notes' => 'Customer VIP',
            ],
            [
                'name' => 'Siti Aminah',
                'phone' => '089876543210',
                'email' => 'siti.aminah@example.com',
                'address' => 'Jl. Sudirman No. 25, Bandung',
                'notes' => '',
            ],
            [
                'name' => 'Agus Pratama',
                'phone' => '085612349876',
                'email' => 'agus.p@example.com',
                'address' => 'Perumahan Indah Blok C2, Surabaya',
                'notes' => 'Tolong hubungi sebelum pengiriman',
            ],
            [
                'name' => 'Rina Melati',
                'phone' => '087711223344',
                'email' => 'rina.melati@example.com',
                'address' => 'Jl. Mawar 5, Yogyakarta',
                'notes' => '',
            ]
        ];

        $customerIds = [];
        $stmtCustomer = $db->prepare("INSERT INTO customers (name, phone, email, address, notes, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        foreach ($customers as $customer) {
            // Check if phone exists
            $stmtCheck = $db->prepare("SELECT id FROM customers WHERE phone = ?");
            $stmtCheck->execute([$customer['phone']]);
            $existingId = $stmtCheck->fetchColumn();

            if ($existingId) {
                $customerIds[] = $existingId;
            } else {
                $now = date('Y-m-d H:i:s');
                $stmtCustomer->execute([
                    $customer['name'],
                    $customer['phone'],
                    $customer['email'],
                    $customer['address'],
                    $customer['notes'],
                    $now,
                    $now
                ]);
                $customerIds[] = $db->lastInsertId();
            }
        }
        echo "Customers seeded successfully.\n";

        // 3. Create Dummy Orders
        // Let's create about 15 dummy orders
        $statuses = ['pending', 'processing', 'delivering', 'completed', 'cancelled'];
        
        $stmtOrder = $db->prepare("INSERT INTO orders (customer_id, event_id, menu_id, event_date, quantity, total_price, delivery_address, notes, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Clear existing orders for idempotency (optional, but good for resetting)
        $db->query("SET FOREIGN_KEY_CHECKS = 0");
        $db->query("TRUNCATE TABLE orders");
        $db->query("SET FOREIGN_KEY_CHECKS = 1");

        for ($i = 0; $i < 15; $i++) {
            $customerId = $customerIds[array_rand($customerIds)];
            $eventId = $events[array_rand($events)];
            $menu = $menus[array_rand($menus)];
            $menuId = $menu['id'];
            $menuPrice = $menu['price'];
            
            // Random quantity between 50 and 500
            $quantity = rand(5, 50) * 10; 
            $totalPrice = $quantity * $menuPrice;

            // Random date in the next 30 days
            $daysOffset = rand(1, 30);
            $eventDate = date('Y-m-d H:i:s', strtotime("+$daysOffset days"));

            $status = $statuses[array_rand($statuses)];
            
            // Notes can be empty or have some request
            $notesOptions = [
                'Tolong dikirim tepat waktu ya',
                'Makanan jangan terlalu pedas',
                'Tolong packing yang rapi',
                '',
                '',
                'Koordinasi dengan satpam depan saat pengiriman'
            ];
            $notes = $notesOptions[array_rand($notesOptions)];
            
            // Fetch customer address for delivery, sometimes vary it
            $stmtAddr = $db->prepare("SELECT address FROM customers WHERE id = ?");
            $stmtAddr->execute([$customerId]);
            $deliveryAddress = $stmtAddr->fetchColumn();
            
            if (rand(1, 10) > 8) {
                $deliveryAddress = "Gedung Serbaguna, " . $deliveryAddress; // Simulate event at a hall
            }

            $now = date('Y-m-d H:i:s', strtotime("-" . rand(0, 10) . " days")); // Created in the past few days

            $stmtOrder->execute([
                $customerId,
                $eventId,
                $menuId,
                $eventDate,
                $quantity,
                $totalPrice,
                $deliveryAddress,
                $notes,
                $status,
                $now,
                $now
            ]);
        }
        echo "15 Orders seeded successfully.\n";
    }
}

OrderSeeder::run();
