<?php


/**
 * Constantes of project
 */
define('ROOT', __DIR__.'/');


/**
 * Autoloader (composer)
 */
require ROOT . 'vendor/autoload.php';


/**
 * Whoops Error Handler
 */
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/**
 * Symfony Dotenv
 */
$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->load(ROOT.'.env');

