<?php

namespace Core\Routing;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Zend\Expressive\Router\RouteResult;

/**
 * Calls the method that matches the current query
 * Class Dispatcher
 * @package Core\Routing
 */
class Dispatcher
{

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
        return new Response(200, [], (string)call_user_func_array($route->handler(), $route->params()));
    }


    /**
     * @return ResponseInterface
     */
    private function badMethod(): ResponseInterface
    {
        return new Response(405, [], 'Bad Method;)');
    }

    /**
     * @return ResponseInterface
     */
    private function noFound(): ResponseInterface
    {
        return new Response(404, [], 'Not Found;)');
    }
}
