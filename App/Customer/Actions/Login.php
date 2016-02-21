<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/21/2015
 * Time: 10:25
 */
namespace App\Customer\Actions;

use App\Customer\Models\User;
use App\Lib\Action\ActionInterface;
use App\Lib\Request\Request;
use App\Lib\Response\Response;
use App\Lib\Session\Session;

class Login implements ActionInterface
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var Response
     */
    private $response;
    /**
     * @var Request
     */
    private $request;

    /**
     * Form constructor.
     *
     * @param User $user
     * @param Request $request
     * @param Response $response
     */
    public function __construct(User $user, Request $request, Response $response)
    {
        $this->user = $user;
        $this->response = $response;
        $this->request = $request;
    }

    /**
     *  Logs in customer.
     */
    public function execute()
    {
        $user = $this->user->findBy('email', $this->request->getPost('email'));
        try {
            $this->user->verify($user);
            Session::set('username', $user['user_name']);
            $this->response->redirect('/');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
