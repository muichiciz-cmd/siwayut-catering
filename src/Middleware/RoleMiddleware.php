<?php
declare(strict_types=1);
// File: src/Middleware/RoleMiddleware.php

namespace App\Middleware;
use App\Core\Request;

class RoleMiddleware implements MiddlewareInterface {
    public function __construct(private string $requiredRole) {
        // TODO: implement
    }

    public function handle(Request $request): bool {
        // TODO: implement
        return false;
    }
}
