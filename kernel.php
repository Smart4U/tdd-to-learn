<?php

return [
    'bundles' => (require ROOT . 'bundles.php'),
    \Core\Bundle\Bundle::class => \DI\object(),
    \Core\Routing\Router::class => \DI\object(),
    \Core\Routing\Route::class => \DI\object(),
    \Core\Routing\Dispatcher::class => \DI\object()
];

