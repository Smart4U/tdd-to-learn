<?php

namespace Core;

use Core\Routing\Router;
use Core\Routing\Dispatcher;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class App
 * @package Core
 */
class App
{

    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var Router|mixed
     */
    private $router;
    /**
     * @var Dispatcher|mixed
     */
    private $dispatcher;
    /**
     * @var array
     */
    private $bundles = [];


    /**
     * App constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->router = $this->container->get(Router::class);
        $this->dispatcher = $this->container->get(Dispatcher::class);

        foreach ($container->get('bundles') as $bundle) {
            $this->bundles[] = $this->container->get($bundle);
        }
    }


    /**
     * @return ResponseInterface
     */
    public function run() :ResponseInterface
    {
        return $this->dispatcher->dispatch(
            $this->router->match(ServerRequest::fromGlobals())
        );
    }
}
