<?php
declare(strict_types=1);
// File: src/Core/Logger.php

namespace App\Core;

class Logger {
    private static string $logPath = '';

    public static function setPath(string $path): void {
        // TODO: implement
    }

    public static function info(string $message, array $context = []): void {
        // TODO: implement
    }

    public static function warning(string $message, array $context = []): void {
        // TODO: implement
    }

    public static function error(string $message, array $context = []): void {
        // TODO: implement
    }

    public static function debug(string $message, array $context = []): void {
        // TODO: implement
    }

    private static function write(string $level, string $message, array $context): void {
        // TODO: implement
    }
}
