<?php
class Router
{
    private $controllerName;

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getQueryString()
    {
        return $this->queryString;
    }
    private $actionName;
    private $queryString;

    public function parseUrl($url)
    {
        if(preg_match('/(.*\/)(.*\/)(.*)/', $url)) {
            array_shift($url);
            $url = $_SERVER['REQUEST_URI'];
            $url = explode('/', $url);
            $this->controllerName = array_shift($url);
            $this->actionName = array_shift($url);
            $this->queryString = $url[0];
        } else {
            return false;
        }

    }
}
