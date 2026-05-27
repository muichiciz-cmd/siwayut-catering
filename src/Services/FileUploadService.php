<?php
declare(strict_types=1);
// File: src/Services/FileUploadService.php

namespace App\Services;

class FileUploadService {
    public function __construct(private string $uploadPath) {
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
    }

    public function upload(array $file, ?string $subdirectory = null): string {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new \RuntimeException('File upload failed with error code: ' . $file['error']);
        }

        $destinationPath = $this->uploadPath;
        if ($subdirectory !== null) {
            $destinationPath .= '/' . $subdirectory;
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
        $destination = $destinationPath . '/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new \RuntimeException('Failed to move uploaded file.');
        }

        return $subdirectory !== null ? $subdirectory . '/' . $filename : $filename;
    }

    public function uploadFromUrl(string $url, ?string $subdirectory = null): string {
        $context = stream_context_create(['http' => ['timeout' => 15, 'user_agent' => 'SiwayutCatering/1.0']]);
        $content = @file_get_contents($url, false, $context);
        if ($content === false) {
            throw new \RuntimeException("Failed to download image from URL: {$url}");
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->buffer($content);

        $extension = match ($mimeType) {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp',
            default      => 'jpg',
        };

        $destinationPath = $this->uploadPath;
        if ($subdirectory !== null) {
            $destinationPath .= '/' . $subdirectory;
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
        }

        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
        $destination = $destinationPath . '/' . $filename;

        if (file_put_contents($destination, $content) === false) {
            throw new \RuntimeException('Failed to save downloaded image.');
        }

        return $subdirectory !== null ? $subdirectory . '/' . $filename : $filename;
    }

    public function delete(string $filename): bool {
        $filepath = $this->uploadPath . '/' . $filename;
        if (file_exists($filepath)) {
            return unlink($filepath);
        }
        return false;
    }
}
