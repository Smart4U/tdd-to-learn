<?php

namespace Core\Routing;

/**
 * Class BadRouteException
 * @package Core\Routing
 */
class BadRouteException extends \Exception
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}
