<?php
class BaseController
{
    private $model;
    private $template;
    private $action;

    public function __construct($model, $action = 'Base')
    {
        $this->model = new $model();
        $this->template = new Template();
        $this->template->render($action);
    }
}