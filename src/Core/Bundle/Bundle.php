<?php

namespace Core\Bundle;

use Core\Routing\Router;

/**
 * Class Bundle
 * @package Core\Bundle
 */
abstract class Bundle
{

    const BUNDLE_SETTINGS = null;

    /**
     * @var string
     */
    protected $name;
    /**
     * @var Router
     */
    protected $router;
    /**
     * @var array
     */
    protected $settings = [];

    /**
     * Bundle constructor.
     * @param Router $router
     * @throws BundleConfigNotFound
     */
    public function __construct(Router $router)
    {
        $this->name =  (string)strtolower(str_replace('Bundle', '', substr(get_called_class(), strrpos(get_called_class(), '\\') + 1)));

        $this->router = $router;

        if (!is_null(static::BUNDLE_SETTINGS)) {
            if (!file_exists(static::BUNDLE_SETTINGS)) {
                throw new BundleConfigNotFound('The settings does not found in: ' . static::BUNDLE_SETTINGS);
            }

            $config = require(static::BUNDLE_SETTINGS);

            foreach ($config as $key => $value) {
                $this->settings[$this->name . '.' . $key] = $value;
            }
        }
    }
}
