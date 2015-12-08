<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../vendor/autoload.php';

$app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();

require __DIR__ . '/../../src/Infrastructure/Ui/Silex/Controllers.php';

$app->run();
