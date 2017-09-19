<?php

return [
    // APP
    'app' => require ROOT . 'config/app.global.php',

    // BUNDLES TO BE LOADED
    'bundles' => require ROOT . 'bundles.php',

    // ROUTER
    'routing' => require ROOT . 'config/routing.global.php',
    \Core\Bundle\Bundle::class => \DI\object(),
    \Core\Routing\Router::class => \DI\object(),
    \Core\Routing\Route::class => \DI\object(),
    \Core\Routing\Dispatcher::class => \DI\object(),

    // CONTROLLER
    \Core\Controller\Controller::class => function(\Psr\Container\ContainerInterface $c) {
        return new Core\Controller\Controller($c);
    },

    // VIEWS
    'views' => require ROOT . 'config/views.global.php',
    \Core\View\View::class => \DI\object()->constructor(DI\get('views'))
];

