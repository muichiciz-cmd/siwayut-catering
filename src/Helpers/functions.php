<?php
declare(strict_types=1);
// File: src/Helpers/functions.php

if (!function_exists('env')) {
    function env(string $key, mixed $default = null): mixed {
        // TODO: implement
        return null;
    }
}
if (!function_exists('config')) {
    function config(string $key, mixed $default = null): mixed {
        // TODO: implement
        return null;
    }
}
if (!function_exists('base_path')) {
    function base_path(string $path = ''): string {
        // TODO: implement
        return '';
    }
}
if (!function_exists('asset')) {
    function asset(string $path): string {
        // TODO: implement
        return '';
    }
}
if (!function_exists('url')) {
    function url(string $path = ''): string {
        // TODO: implement
        return '';
    }
}
if (!function_exists('old')) {
    function old(string $key, mixed $default = ''): mixed {
        // TODO: implement
        return null;
    }
}
if (!function_exists('csrf_field')) {
    function csrf_field(): string {
        // TODO: implement
        return '';
    }
}
if (!function_exists('e')) {
    function e(mixed $value): string {
        // TODO: implement
        return '';
    }
}
if (!function_exists('dd')) {
    function dd(mixed ...$vars): never {
        // TODO: implement
        exit;
    }
}
if (!function_exists('now')) {
    function now(): string {
        // TODO: implement
        return '';
    }
}
