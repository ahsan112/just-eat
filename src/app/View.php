<?php 


namespace App;


class View 
{

    private $view;
    private $params;

    public function __construct(string $view, array $params)
    {
        $this->view = $view;
        $this->params = $params;    
    }

    public static function make(string $view, array $params = []): View
    {
        return new static($view, $params);
    }

    public function render(): string 
    {
        $viewPath = VIEW_PATH . '/' . $this->view . '.php';

        // if (! file_exists($viewPath)) {
        //     throw new ViewNotFoundException();     
        // }

        extract($this->params);

        ob_start();

        include $viewPath;

        return (string) ob_get_clean();
    }

    public function __toString()
    {
        return $this->render();
    }
}