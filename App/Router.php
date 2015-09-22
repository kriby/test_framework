<?php
namespace App;

class Router
{
    private $controllerName;
    private $actionName;
    private $queryString;

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

    /**
     * @param $url
     * @return bool
     */
    public function parseUrl($url)
    {
        $url = explode('/', trim($url, '//'));
        array_shift($url); /** remove test_framework before request */
        $this->controllerName = ucwords(array_shift($url));
        $this->actionName = ucwords(array_shift($url));
        $this->queryString = $url;
        if (!file_exists(
            ROOT . DS . 'App' . DS . $this->controllerName . DS . 'Controller' . DS . $this->actionName . '.php'
        )) {
            return false;
        } else {
            $this->controllerName = 'App\\' . $this->controllerName . '\\' . 'Controller\\' . $this->actionName;
            return true;
        }
    }
}
