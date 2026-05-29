<?php
declare(strict_types=1);

namespace App\Models;

class Menu extends BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'menus';
        $this->sortableColumns = ['id', 'name', 'price', 'category_id', 'status', 'created_at'];
        $this->searchableColumns = [
            'id',
            'name',
            'description',
            'price',
            'category_id',
            'event_id',
            'minimum_portions',
            'image',
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function countByCategoryIds(array $ids): array {
        if (empty($ids)) return [];
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT category_id, COUNT(*) as cnt FROM `menus` WHERE category_id IN ($placeholders) GROUP BY category_id";
        $stmt = $this->db()->prepare($sql);
        $stmt->execute(array_map('intval', $ids));
        $result = [];
        foreach ($stmt->fetchAll() as $row) {
            $result[(int)$row['category_id']] = (int)$row['cnt'];
        }
        return $result;
    }

    public function countByEventIds(array $ids): array {
        if (empty($ids)) return [];
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT event_id, COUNT(*) as cnt FROM `menus` WHERE event_id IN ($placeholders) GROUP BY event_id";
        $stmt = $this->db()->prepare($sql);
        $stmt->execute(array_map('intval', $ids));
        $result = [];
        foreach ($stmt->fetchAll() as $row) {
            $result[(int)$row['event_id']] = (int)$row['cnt'];
        }
        return $result;
    }
}
