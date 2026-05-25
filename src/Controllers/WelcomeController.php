<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;

class WelcomeController extends BaseController {
    public function index(Request $request): void {
        $this->render('welcome', ['title' => 'Welcome to Vanilla Framework'], '');
    }
}
