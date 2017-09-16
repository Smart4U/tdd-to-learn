<?php

namespace Core\Routing;

use GuzzleHttp\Psr7\Response;
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
     * @return Response
     */
    public function dispatch(RouteResult $routeResult): Response
    {

        if ($routeResult->isSuccess()) {
            return $this->found($routeResult);
        }

        if ($routeResult->isMethodFailure()) {
            return $this->badMethod($routeResult);
        }

        return $this->noFound($routeResult);
    }

    /**
     * @param RouteResult $routeResult
     * @return Response
     */
    private function found(RouteResult $routeResult): Response
    {
        $route = new Route($routeResult->getMatchedRouteName(), $routeResult->getMatchedMiddleware(), $routeResult->getMatchedParams());
        return new Response(200, [], call_user_func_array($route->handler(), $route->params()));
    }

    /**
     * @param RouteResult $routeResult
     * @return Response
     */
    private function badMethod(RouteResult $routeResult): Response
    {
        return new Response(405, [], 'Bad Method;)');
    }

    /**
     * @param RouteResult $routeResult
     * @return Response
     */
    private function noFound(RouteResult $routeResult): Response
    {
        return new Response(404, [], 'Not Found;)');
    }
}
