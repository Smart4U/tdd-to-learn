<?php

namespace Core\Routing;

use Throwable;

class BadRouteException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}
