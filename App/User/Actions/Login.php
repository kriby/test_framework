<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/21/2015
 * Time: 10:25
 */
namespace App\User\Actions;

use App\User\Models\UserDAO;
use App\User\Models\UserService;
use App\User\Models\UserVO;
use App\Lib\Action\ActionInterface;
use App\Lib\Request\Request;
use App\Lib\Response\Response;
use App\Lib\Session\Session;

class Login implements ActionInterface
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var Response
     */
    private $response;

    /**
     * @var Request
     */
    private $request;

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
        $this->userService = $userService;
        $this->response = $response;
        $this->request = $request;
        $this->userDAO = $userDAO;
        $this->userVO = $userVO;
    }

    /**
     *  Logs in customer.
     */
    public function execute()
    {
        $user = $this->userDAO->getByUserEmail($this->request->getPost('email'));
        try {
            if(!$user->getEmail()) {
                throw new \Exception('User with specified email does not exist.');
            }
            $isPasswordVerified = $this->userService->verify(
                $this->request->getPost('password'),
                $user->getUserPassword()
            );
            if (!$isPasswordVerified) {
                throw new \Exception('Invalid username/password. Check your credentials.');
            }
            $this->userService->verify(
                $this->request->getPost('password'),
                $user->getUserPassword()
            );
            Session::setMessage('You have successfully logged in!');
            Session::set('username', $user->getUserName());
            $this->response->redirect('/');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
