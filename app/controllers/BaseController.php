<?php
class BaseController
{
    private $model;
    private $template;
    private $action;

    public function __construct($model, $action = 'Base')
    {
        $this->model = new $model();
        $this->action = $action;
        $this->template = new Template();
    }

    public function baseAction()
    {
        $this->template->render($this->action);
    }
}