<?php

namespace Tests\Feature\Core\Routing;


use Core\Routing\Route;
use Core\Routing\Router;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;

use PHPUnit\Framework\TestCase;
use Zend\Expressive\Router\RouteResult;

class RouterTest extends TestCase
{

    private $router;

    public function setup(){
        $this->router = new Router();
        $this->router->get('/', function () {
            return 'homepage';
        }, 'homepage');
        $this->router->get('/article/{slug:[0-9a-zA-Z\-]+}-{id:[0-9]+}', function () {
            return 'article';
        }, 'blog.show');
    }

    private function defineRequest(string $method, string $path, array $headers = [], string $body = null) {
        return new ServerRequest($method, $path, $headers, $body);
    }

    private function defineRoute(string $name = null, callable $handler, array $params = []){
        return new Route($name, $handler, $params);
    }

    private function defineResponse(int $statusCode, array $headers = [], string $body = null){
        return new Response($statusCode, $headers, $body);
    }

    public function testHomepageReturnAnResponseInterface(){
        $request = $this->defineRequest('GET', '/', [], null);

        $routeResult = $this->router->match($request);
        $this->assertInstanceOf(RouteResult::class, $routeResult);
        $this->assertSame($routeResult->isSuccess(), true);

        $route = $this->defineRoute($routeResult->getMatchedRouteName(), $routeResult->getMatchedMiddleware(), $routeResult->getMatchedParams());
        $this->assertInstanceOf(Route::class, $route);

        $response = $this->defineResponse(200, [], call_user_func_array($route->handler(), $route->params()), $route->params());
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals($response->getBody()->getContents(), 'homepage');
    }


    public function testBlogShowReturnAnResponseInterface(){
        $request = $this->defineRequest('GET', '/article/slug-1', [], null);

        $routeResult = $this->router->match($request);
        $this->assertInstanceOf(RouteResult::class, $routeResult);
        $this->assertSame($routeResult->isSuccess(), true);

        $route = $this->defineRoute($routeResult->getMatchedRouteName(), $routeResult->getMatchedMiddleware(), $routeResult->getMatchedParams());
        $this->assertInstanceOf(Route::class, $route);

        $params = $route->params();
        $response = $this->defineResponse(200, [], 'article : ' . $params['slug'] . '-' . $params['id']);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals($response->getStatusCode(), 200);
        $this->assertEquals($response->getBody()->getContents(), 'article : slug-1');
    }

    public function testMethodNotAllowedFound(){
        $request = $this->defineRequest('PATCH', '/', [], null);

        $routeResult = $this->router->match($request);
        $this->assertInstanceOf(RouteResult::class, $routeResult);
        $this->assertSame($routeResult->isMethodFailure(), true);

        $route = $this->defineRoute('badmethod', function () { return 'Bas Method;)'; }, []);
        $this->assertInstanceOf(Route::class, $route);

        $response = $this->defineResponse(405, [], 'Bad Method;)');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals($response->getStatusCode(), 405);
        $this->assertEquals($response->getBody()->getContents(), 'Bad Method;)');
    }

    public function testPageNotFound(){
        $request = $this->defineRequest('GET', '/notfound', [], null);

        $routeResult = $this->router->match($request);
        $this->assertInstanceOf(RouteResult::class, $routeResult);
        $this->assertSame($routeResult->isFailure(), true);

        $route = $this->defineRoute('notfound', function () { return 'Not Found;)'; }, []);
        $this->assertInstanceOf(Route::class, $route);

        $response = $this->defineResponse(404, [], 'Not Found;)');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals($response->getStatusCode(), 404);
        $this->assertEquals($response->getBody()->getContents(), 'Not Found;)');
    }

    public function testMethodGetURL() {
        $url = $this->router->getUrl('blog.show', ['slug' => 'slug', 'id' => 1]);
        $this->assertEquals('/article/slug-1', $url);
    }


}