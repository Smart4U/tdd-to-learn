<?php

namespace Tests\Feature\Core;

use Core\App;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{

    private $app;

    public function setUp()
    {
        $this->app = new App();
    }

    public function testRunReturnResponse(){
        $this->assertEquals($this->app->run(), 'app loaded...');
    }

}