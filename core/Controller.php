<?php


namespace core;

abstract class Controller
{
    public $layout;
    public $view ;
    public $vars = [];
    public $flash ;
    public $messages;
    //public $route = [];

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function setView($view = null)
    {
       $this->view = $view;
    }

    public function getView()
    {

        $viewMain = new View($this->view, $this->layout);
        $viewMain->render($this->vars, $this->messages);

    }

    /**
     * передає параметри користувача змінній $vars
     * @param $vars
     */
    public function set(array $vars)
    {
        $this->vars = $vars;
    }

    public function errors($message, $error = null)
    {
        $this->errors = $message . ' '. $error;
    }

}