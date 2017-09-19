<?php

namespace Core\Routing;

/**
 * Class BadMethodRouterException
 * @package Core\Routing
 */
class BadMethodRouterException extends \Exception
{

    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, 405, $previous);
    }
}
