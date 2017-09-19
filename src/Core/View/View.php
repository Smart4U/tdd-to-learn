<?php

namespace Core\View;

/**
 * Class View
 * @package Core\View
 */
class View
{

    /**
     * @var \Twig_Loader_Filesystem
     */
    private $loader;
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * View constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->loader = new \Twig_Loader_Filesystem($config['views.path']);
        $this->twig = new \Twig_Environment($this->loader, [
            'cache' => $config['views.cache']
        ]);
    }

    /**
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []) :string
    {
        return $this->twig->render($view . '.twig', $params);
    }
}
