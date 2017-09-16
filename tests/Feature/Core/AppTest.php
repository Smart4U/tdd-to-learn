<?php

namespace Tests\Feature\Core;

use Core\App;
use GuzzleHttp\Psr7\Response;

use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{

    private $app;

    public function setUp()
    {
        $this->app = new App();
    }

    public function testRunReturnResponse(){
        $this->assertInstanceOf(App::class, $this->app);
        $this->assertInstanceOf(Response::class, $this->app->run());
    }

}