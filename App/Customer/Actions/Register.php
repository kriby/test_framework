<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/12/2015
 * Time: 20:02
 */

namespace App\Customer\Actions;

use App\Customer\Models\User;
use App\Lib\Action\ActionInterface;
use App\Lib\Request\Request;
use App\Lib\Response\Response;
use App\Lib\Session\Session;


class Register implements ActionInterface
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
        $this->request = $request;
        $this->response = $response;
    }

    /**
     *  Validates user input in Register form and saves customer into database.
     */
    public function execute()
    {
        $this->user->email = $this->request->getPost('email');
        $this->user->username = $this->request->getPost('username');
        $this->user->password = $this->request->getPost('password');
        $this->user->password = $this->request->getPost('password_confirm');
        if ($this->validate()) {
            try {
                $this->user->save();
                Session::set('username', $this->user->username);
                $this->response->redirect('/');
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            throw new \Exception('Password and Confirm Password fields should be the same.');
        }
    }

    /**
     * Validates user input.
     *
     * @return bool
     */
    private function validate()
    {
        return $this->user->password === $this->user->password_confirm;
    }
}
