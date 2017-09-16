<?php

namespace Tests\Feature\Core\Routing;


use Core\Routing\Route;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{

    private $route;

    public function setUp()
    {
        $this->route = new Route('homepage', function () { return 'homepage'; }, []);
    }

    public function testGetName(){
        $this->assertEquals('homepage', $this->route->name());
    }

    public function testGetHandler(){
        $this->assertEquals(function () { return 'homepage'; }, $this->route->handler());
    }


    public function testGetParams(){
        $this->assertEquals([], $this->route->params());
    }

}