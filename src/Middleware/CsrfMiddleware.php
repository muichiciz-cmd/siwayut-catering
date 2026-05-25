<?php
declare(strict_types=1);
// File: src/Middleware/CsrfMiddleware.php

namespace App\Middleware;
use App\Core\Request;

class CsrfMiddleware implements MiddlewareInterface {
    public function handle(Request $request): bool {
        // TODO: implement
        return false;
    }
}
