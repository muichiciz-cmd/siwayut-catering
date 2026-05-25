<?php
declare(strict_types=1);
// File: src/Middleware/AuthMiddleware.php

namespace App\Middleware;
use App\Core\Request;

class AuthMiddleware implements MiddlewareInterface {
    public function handle(Request $request): bool {
        // TODO: implement real check
        return true;
    }
}
