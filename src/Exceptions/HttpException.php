<?php
declare(strict_types=1);
// File: src/Exceptions/HttpException.php

namespace App\Exceptions;

class HttpException extends AppException {
    private int $statusCode;

    // CONTRACT: Constructor MUST assign $statusCode property.
    public function __construct(int $code, string $message = '') {
        $this->statusCode = $code;
        // TODO: implement
    }

    public function getStatusCode(): int {
        // TODO: implement
        return 500;
    }

    private function defaultMessage(int $code): string {
        return match ($code) {
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            419 => 'Page Expired',
            422 => 'Unprocessable Entity',
            429 => 'Too Many Requests',
            500 => 'Internal Server Error',
            default => 'HTTP Error',
        };
    }
}
