<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/12/2015
 * Time: 20:02
 */

namespace App\User\Actions;

use App\User\Models\UserDAO;
use App\User\Models\UserService;
use App\User\Models\UserVO;
use App\Lib\Action\ActionInterface;
use App\Lib\Request\Request;
use App\Lib\Response\Response;
use App\Lib\Session\Session;


class Register implements ActionInterface
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var UserDAO
     */
    private $userDAO;

    /**
     * @var UserVO
     */
    private $userVO;

    /**
     * Form constructor.
     *
     * @param UserService $userService
     * @param UserDAO $userDAO
     * @param UserVO $userVO
     * @param Request $request
     * @param Response $response
     * @internal param User $user
     */
    public function __construct(
        UserService $userService,
        UserDAO $userDAO,
        UserVO $userVO,
        Request $request,
        Response $response
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->userService = $userService;
        $this->userDAO = $userDAO;
        $this->userVO = $userVO;
    }

    /**
     *  Validates user input in Register form and saves customer into database.
     */
    public function execute()
    {
        $this->userVO->setEmail($this->request->getPost('email'));
        $this->userVO->setUserName($this->request->getPost('username'));
        $this->userVO->setUserPassword(
            $this->userService->hashPassword($this->request->getPost('password'))
        );
        if ($this->validate()) {
            try {
                $this->userDAO->save($this->userVO);
                UserVO::setMessage('Thank you for registering on our website!');
                Session::set('username', $this->userVO->getUserName());
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
     */
    private function validate() : bool
    {
        $password = trim($this->request->getPost('password'));
        $confirm = trim($this->request->getPost('password_confirm'));
        return $password == $confirm;
    }
}
