<?php

use function Http\Response\send;

$container = require dirname(__DIR__) . '/bootstrap.php';

$bundles = require ROOT . 'bundles.php';

$app = new \Core\App($container);

send($app->run());
