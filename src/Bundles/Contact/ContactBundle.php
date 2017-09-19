<?php


namespace Bundles\Contact;

use Core\Bundle\Bundle;
use Core\Routing\Router;

use Bundles\Contact\Controllers\ContactController;

/**
 * Class ContactBundle
 * @package Bundles\Contact
 */
class ContactBundle extends Bundle
{

    const BUNDLE_SETTINGS = __DIR__ . '/settings.php';

    /**
     * ContactBundle constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        parent::__construct($router);

        $this->setRoutesBundle();
    }

    /**
     * define bundles routes
     */
    private function setRoutesBundle() :void
    {
        $this->router->get('/contact', [ContactController::class, 'indexAction'], 'contact.index');
    }
}
