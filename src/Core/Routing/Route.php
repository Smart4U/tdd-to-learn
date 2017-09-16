<?php

namespace Core\Routing;

/**
 * Class Route
 * represents a valid route
 * @package Core\Routing
 */
class Route
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var callable
     */
    private $handler;
    /**
     * @var array
     */
    private $params = [];



    public function __construct(string $name, callable $handler, array $params)
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->params = $params;
    }


    /**
     * @return string
     */
    public function name(): ?string
    {
        return $this->name;
    }


    /**
     * @return callable
     */
    public function handler() :callable
    {
        return $this->handler;
    }

    /**
     * @return array
     */
    public function params() :array
    {
        return $this->params;
    }
}
