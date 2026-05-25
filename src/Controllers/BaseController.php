<?php
declare(strict_types=1);
// File: src/Controllers/BaseController.php

namespace App\Controllers;
use App\Core\View;

abstract class BaseController {
    protected View $view;

    // CONTRACT: Constructor MUST instantiate: $this->view = new View(BASE_PATH . '/src/Views');
    public function __construct() {
        $this->view = new View(BASE_PATH . '/src/Views');
    }

    protected function render(string $template, array $data = [], string $layout = 'main'): void {
        $this->view->render($template, $data, $layout);
    }

    protected function redirect(string $url): never {
        // TODO: implement
        exit;
    }

    protected function redirectWithFlash(string $url, string $type, string $message): never {
        // TODO: implement
        exit;
    }

    protected function currentUser(): ?array {
        // TODO: implement
        return null;
    }

    protected function back(string $fallback = '/dashboard'): never {
        // TODO: implement
        exit;
    }

    protected function withOldInput(array $data): void {
        // TODO: implement
    }
}
