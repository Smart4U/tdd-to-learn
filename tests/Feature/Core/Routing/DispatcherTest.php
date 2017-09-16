<?php

namespace Tests\Feature\Core\Routing;


use GuzzleHttp\Psr7\ServerRequest;
use Core\Routing\Dispatcher;
use Core\Routing\Router;

use PHPUnit\Framework\TestCase;

class DispatcherTest extends TestCase
{

    private $router;
    private $dispatcher;

    public function setUp() {
        $this->router = new Router();
        $this->router->get('/', function () {
            return 'homepage';
        }, 'homepage');
        $this->router->get('/article/{slug:[0-9a-zA-Z\-]+}-{id:[0-9]+}', function () {
            return 'article';
        }, 'blog.show');

        $this->dispatcher = new Dispatcher();
    }

    private function defineRequest(string $method, string $path, array $headers = [], string $body = null) {
        return new ServerRequest($method, $path, $headers, $body);
    }

   public function testReturnMethodFound() {
        $request = $this->defineRequest('GET', '/', [], null);
        $routeResult = $this->router->match($request);
        $response = $this->dispatcher->dispatch($routeResult);
        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals($response->getBody()->getContents(), 'homepage');
    }

    public function testReturnMethodNotFound() {
        $request = $this->defineRequest('GET', '/notfound', [], null);
        $routeResult = $this->router->match($request);
        $response = $this->dispatcher->dispatch($routeResult);
        $this->assertEquals($response->getStatusCode(), 404);
        $this->assertEquals($response->getBody()->getContents(), 'Not Found;)');
    }

    public function testReturnMethodBadMethod() {
        $request = $this->defineRequest('PATCH', '/', [], null);
        $routeResult = $this->router->match($request);
        $response = $this->dispatcher->dispatch($routeResult);
        $this->assertEquals($response->getStatusCode(), 405);
        $this->assertEquals($response->getBody()->getContents(), 'Bad Method;)');
    }

}