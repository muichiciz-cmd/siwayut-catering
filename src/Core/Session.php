<?php
declare(strict_types=1);
// File: src/Core/Session.php

namespace App\Core;

class Session {
    public static function start(): void {
        // TODO: implement
    }

    public static function set(string $key, mixed $value): void {
        // TODO: implement
    }

    public static function get(string $key, mixed $default = null): mixed {
        // TODO: implement
        return null;
    }

    public static function forget(string $key): void {
        // TODO: implement
    }

    public static function has(string $key): bool {
        // TODO: implement
        return false;
    }

    public static function destroy(): void {
        // TODO: implement
    }

    public static function flash(string $key, string $message): void {
        // TODO: implement
    }

    public static function getFlash(string $key): ?string {
        // TODO: implement
        return null;
    }

    public static function regenerate(bool $deleteOld = true): void {
        // TODO: implement
    }

    public static function old(): array {
        // TODO: implement
        return [];
    }

    public static function setOld(array $data): void {
        // TODO: implement
    }
}
