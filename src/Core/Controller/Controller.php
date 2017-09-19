<?php

namespace Core\Controller;

use Core\View\View;

/**
 * Class Controller
 * @package Core\Controller
 */
class Controller
{
    /**
     * @var View|mixed
     */
    protected $view;

    /**
     * Controller constructor.
     * @param View $view
     */
    public function __construct(View $view)
    {
        $this->view = $view;
    }
}
