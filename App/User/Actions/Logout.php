<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/12/2015
 * Time: 20:02
 */

namespace App\User\Actions;

use App\Lib\Action\ActionInterface;
use App\Lib\Response\Response;
use App\Lib\Session\Session;


class Logout implements ActionInterface
{
    /**
     * @var Response
     */
    private $response;

    /**
     * Logout constructor.
     *
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     *  Logs out user.
     */
    public function execute()
    {
        Session::destroy();
        $this->response->redirect('/');
    }
}
