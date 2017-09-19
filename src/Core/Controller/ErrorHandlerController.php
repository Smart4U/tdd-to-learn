<?php

namespace Core\Controller;

/**
 * Class ErrorHandlerController
 * @package Core\Controller
 */
class ErrorHandlerController extends Controller
{

    /**
     * @return string
     */
    public function errorMethodHandlerAction() :string
    {
        return $this->view->render('errors/400/404');
    }

    /**
     * @return string
     */
    public function errorNotFoundHandlerAction() :string
    {
        return $this->view->render('errors/400/404');
    }
}
