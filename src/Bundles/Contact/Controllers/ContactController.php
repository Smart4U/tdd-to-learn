<?php

namespace Bundles\Contact\Controllers;

use Core\Controller\Controller;

/**
 * Class ContactController
 * @package Bundles\Contact\Controllers
 */
class ContactController extends Controller
{

    /**
     * @return string
     */
    public function indexAction() :string
    {
        return $this->view->render('contact/index');
    }
}
