<?php
declare(strict_types=1);
// File: src/Core/Response.php

namespace App\Core;

// CONTRACT: All methods returning `never` MUST terminate using exactly: exit;
class Response {
    public static function redirect(string $url, int $code = 302): never {
        http_response_code($code);
        header('Location: ' . $url);
        exit;
    }

    public static function json(mixed $data, int $code = 200): never {
        // TODO: implement
        exit;
    }

    public static function jsonSuccess(mixed $data = null, string $message = 'OK', int $code = 200): never {
        // TODO: implement
        exit;
    }

    public static function jsonError(string $message, array $errors = [], int $code = 400): never {
        // TODO: implement
        exit;
    }

    public static function setStatusCode(int $code): void {
        // TODO: implement
    }

    public static function text(string $text, int $code = 200): never {
        // TODO: implement
        exit;
    }

    public static function download(string $filePath, string $filename): never {
        // TODO: implement
        exit;
    }
}
