<?php
declare(strict_types=1);
// File: bootstrap/app.php

use App\Core\{Container, Session, Logger};

Logger::setPath(BASE_PATH . '/storage/logs');

set_exception_handler(function (Throwable $e) {
    Logger::error($e->getMessage(), [
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString(),
    ]);
    if (APP_DEBUG) {
        // TODO: implement
    } else {
        // TODO: implement
    }
    exit(1);
});

Session::start();
$container = new Container();
require BASE_PATH . '/config/bindings.php';
return $container;
