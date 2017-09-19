<?php

namespace Core;

use Core\Routing\Router;
use Core\Routing\Dispatcher;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ResponseInterface;

/**
 * Class App
 * @package Core
 */
class App
{

    private $router;
    private $dispatcher;
    private $bundles = [];


    /**
     * App constructor.
     * @param array $bundles
     */
    public function __construct(array $bundles)
    {
        $this->router = new Router();
        $this->dispatcher = new Dispatcher();
        foreach ($bundles as $bundle) {
            $this->bundles[] = new $bundle($this->router);
        }
    }


    /**
     * @return ResponseInterface
     */
    public function run() :ResponseInterface
    {
        $request = ServerRequest::fromGlobals();
        return $this->dispatcher->dispatch(
            $this->router->match($request)
        );
    }
}
