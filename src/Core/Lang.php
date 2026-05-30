<?php

declare(strict_types=1);

namespace App\Core;

class Lang
{
    private static array $translations = [];
    private static ?string $locale = null;

    public static function get(string $key, array $replace = []): string
    {
        if (self::$locale === null) {
            self::$locale = Session::get('locale') ?? 'id';
            self::load();
        }

        $translation = self::$translations[$key] ?? $key;

        if (!empty($replace)) {
            foreach ($replace as $search => $value) {
                $translation = str_replace(':' . $search, (string) $value, $translation);
            }
        }

        return $translation;
    }

    private static function load(): void
    {
        $path = BASE_PATH . '/lang/' . self::$locale . '.php';
        
        if (file_exists($path)) {
            self::$translations = require $path;
        } else {
            // Fallback to English
            $fallbackPath = BASE_PATH . '/lang/en.php';
            if (file_exists($fallbackPath)) {
                self::$translations = require $fallbackPath;
            }
        }
    }
}
