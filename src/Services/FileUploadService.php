<?php
declare(strict_types=1);
// File: src/Services/FileUploadService.php

namespace App\Services;

class FileUploadService {
    public function __construct(private string $uploadPath) {
        // TODO: implement
    }

    public function upload(array $file): string {
        // TODO: implement
        return '';
    }

    public function delete(string $filename): bool {
        // TODO: implement
        return false;
    }
}
