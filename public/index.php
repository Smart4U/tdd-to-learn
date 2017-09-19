<?php

use function Http\Response\send;

require dirname(__DIR__) . '/bootstrap.php';

$bundles = require ROOT . 'bundles.php';

$app = new \Core\App($bundles);

send($app->run());
