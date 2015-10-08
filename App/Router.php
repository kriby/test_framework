<?php
namespace App;

class Router
{
    /**
     * Method parses requested url and returns an array with Module name and Action name
     *
     * @param $server
     * @return array
     * @throws \Exception
     */
    public function parseUrl($server)
    {
        $path = parse_url($server['REQUEST_URI'], PHP_URL_PATH);

        if (preg_match('/([\w]+\/)([\w]+[\/{0,1}])/', $path)) {
            return [
                'module' => ucwords($path[0]),
                'action' => ucwords($path[1])
            ];
        } elseif(preg_match('/\//', $path)) {
            return [
                'module' => 'Customer',
                'action' => 'Login'
            ];
        } else {
            throw new \Exception('BAD REQUEST.');
        }
    }
}
