<?php
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
        $url = explode('/', $url);
        array_shift($url); /** remove slash before request */
        array_shift($url); /** remove test_framework before request */
        if(!file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . ucwords($url[0]) . 'Controller.php')) {
            $this->notFound();
        }
        $this->controllerName = array_shift($url);
        if(isset($url[0])) {
            $this->actionName = array_shift($url);
        } else {
            return null;
        }
        $this->queryString = $url;
        return true;
    }

    private function notFound()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}
