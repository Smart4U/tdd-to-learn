<?php

namespace Core\Routing;

use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Expressive\Router\RouteResult;
use Core\Controller\ErrorHandlerController;

/**
 * Calls the method that matches the current query
 * Class Dispatcher
 * @package Core\Routing
 */
class Dispatcher
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param RouteResult $routeResult
     * @return ResponseInterface
     */
    public function dispatch(RouteResult $routeResult): ResponseInterface
    {

        if ($routeResult->isSuccess()) {
            return $this->found($routeResult);
        }

        if ($routeResult->isMethodFailure()) {
            return $this->badMethod();
        }

        return $this->noFound();
    }


    /**
     * @param RouteResult $routeResult
     * @return ResponseInterface
     */
    private function found(RouteResult $routeResult): ResponseInterface
    {
        $route = new Route($routeResult->getMatchedRouteName(), $routeResult->getMatchedMiddleware(), $routeResult->getMatchedParams());
        [$controller, $action] = $route->handler();
        $handlerResponse = $this->container->get($controller)->$action();
        return new Response(200, [], $handlerResponse);
    }

    /**
     * @return ResponseInterface
     * @throws BadMethodRouterException
     */
    private function badMethod(): ResponseInterface
    {
        if ($this->container->has('app')) {
            if (isset($this->container->get('app')['app.debug']) && $this->container->get('app')['app.debug']) {
                throw new BadMethodRouterException('Method does not allowed.');
            }
        }
        $handlerResponse = $this->container->get(ErrorHandlerController::class)->errorMethodHandlerAction();
        return new Response(405, [], $handlerResponse);
    }

    /**
     * @return ResponseInterface
     * @throws BadRouteException
     */
    private function noFound(): ResponseInterface
    {
        if ($this->container->has('app')) {
            if (isset($this->container->get('app')['app.debug']) && $this->container->get('app')['app.debug']) {
                throw new BadRouteException('Cannot resolve this route.');
            }
        }
        $handlerResponse = $this->container->get(ErrorHandlerController::class)->errorNotFoundHandlerAction();
        return new Response(404, [], $handlerResponse);
    }
}
