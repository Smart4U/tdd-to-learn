<?php

namespace Core\Routing;

use Fig\Http\Message\RequestMethodInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as ZendRoute;

/**
 * Class Router
 * @package Core\Routing
 */
class Router
{

    /**
     * @var FastRouteRouter
     */
    private $router;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->router = new FastRouteRouter();
    }

    /**
     * @param string $path
     * @param callable $handler
     * @param null|string $name
     */
    public function head(string $path, callable $handler, ?string $name = null): void
    {
        $this->add(RequestMethodInterface::METHOD_HEAD, $path, $handler, $name);
    }

    /**
     * @param string $path
     * @param callable $handler
     * @param null|string $name
     */
    public function get(string $path, callable $handler, ?string $name = null): void
    {
        $this->add(RequestMethodInterface::METHOD_GET, $path, $handler, $name);
    }

    /**
     * @param string $path
     * @param callable $handler
     * @param null|string $name
     */
    public function post(string $path, callable $handler, ?string $name = null): void
    {
        $this->add(RequestMethodInterface::METHOD_POST, $path, $handler, $name);
    }

    /**
     * @param string $path
     * @param callable $handler
     * @param null|string $name
     */
    public function put(string $path, callable $handler, ?string $name = null): void
    {
        $this->add(RequestMethodInterface::METHOD_PUT, $path, $handler, $name);
    }

    /**
     * @param string $path
     * @param callable $handler
     * @param null|string $name
     */
    public function patch(string $path, callable $handler, ?string $name = null): void
    {
        $this->add(RequestMethodInterface::METHOD_PATCH, $path, $handler, $name);
    }

    /**
     * @param string $path
     * @param callable $handler
     * @param null|string $name
     */
    public function delete(string $path, callable $handler, ?string $name = null): void
    {
        $this->add(RequestMethodInterface::METHOD_DELETE, $path, $handler, $name);
    }

    /**
     * @param string $path
     * @param callable $handler
     * @param null|string $name
     */
    public function options(string $path, callable $handler, ?string $name = null): void
    {
        $this->add(RequestMethodInterface::METHOD_OPTIONS, $path, $handler, $name);
    }

    /**
     * @param string $path
     * @param callable $handler
     * @param null|string $name
     */
    public function trace(string $path, callable $handler, ?string $name = null): void
    {
        $this->add(RequestMethodInterface::METHOD_TRACE, $path, $handler, $name);
    }

    /**
     * @param string $method
     * @param string $path
     * @param callable $handler
     * @param null|string $name
     */
    public function add(string $method, string $path, callable $handler, ?string $name = null): void
    {
        $this->router->addRoute(new ZendRoute($path, $handler, [$method], $name));
    }

    /**
     * @param ServerRequestInterface $request
     * @return \Zend\Expressive\Router\RouteResult
     */
    public function match(ServerRequestInterface $request)
    {
        return $this->router->match($request);
    }

    /**
     * @param string|null $name
     * @param array $params
     * @return null|string
     */
    public function getUrl(string $name = null, array $params = []): ?string
    {
        return $this->router->generateUri($name, $params);
    }
}
