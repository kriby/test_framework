<?php
class Template
{
    private $action;

    public function __construct($action)
    {
        $this->action = $action;
    }

    public function render()
    {
        if(file_exists('views' . DIRECTORY_SEPARATOR . $this->action . DIRECTORY_SEPARATOR . '.php')) {
            include('views' . DIRECTORY_SEPARATOR . $this->action . DIRECTORY_SEPARATOR . '.php');
        } else {
            echo 'There are no available views';
        }
    }
}