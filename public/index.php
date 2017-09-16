<?php

use function Http\Response\send;

require dirname(__DIR__) . '/bootstrap.php';

$app = new \Core\App();

send($app->run());
