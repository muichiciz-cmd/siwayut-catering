<?php
declare(strict_types=1);
// File: src/Core/Request.php

namespace App\Core;

class Request {
    private array $routeParams = [];

    public function method(): string {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function uri(): string {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($uri, '?');
        if ($position !== false) {
            $uri = substr($uri, 0, $position);
        }
        return rtrim($uri, '/') ?: '/';
    }

    public function input(string $key, mixed $default = null): mixed {
        // TODO: implement
        return null;
    }

    public function only(array $keys): array {
        // TODO: implement
        return [];
    }

    public function all(): array {
        // TODO: implement
        return [];
    }

    public function file(string $key): ?array {
        // TODO: implement
        return null;
    }

    public function has(string $key): bool {
        // TODO: implement
        return false;
    }

    public function setRouteParams(array $params): void {
        // TODO: implement
    }

    public function param(string $key, mixed $default = null): mixed {
        // TODO: implement
        return null;
    }

    public function isAjax(): bool {
        // TODO: implement
        return false;
    }

    public function expectsJson(): bool {
        // TODO: implement
        return false;
    }

    public function ip(): string {
        // TODO: implement
        return '';
    }
}
