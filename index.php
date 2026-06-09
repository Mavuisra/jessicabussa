<?php

declare(strict_types=1);

require __DIR__ . '/bootstrap/app.php';
bootstrap_app(__FILE__);

use App\Core\Application;

Application::run();
