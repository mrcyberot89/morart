<?php

use function PHPUnit\Framework\directoryExists;

require __DIR__.'/../vendor/autoload.php';
define('LARAVEL_START', microtime(true));
require __DIR__.'/../bootstrap/app.php';