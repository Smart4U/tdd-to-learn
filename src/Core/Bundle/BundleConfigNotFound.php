<?php

namespace Core\Bundle;

/**
 * Class BundleConfigNotFound
 * @package Core\Bundle
 */
class BundleConfigNotFound extends \Exception
{

    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}
