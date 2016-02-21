<?php
namespace App\Customer\Actions\Login;

use App\Lib\Action\ActionInterface;
use App\Lib\Response\Response;
use App\Lib\Session\Session;
use App\Lib\View\Template;

class Form implements ActionInterface
{
    private $template;
    /**
     * @var Response
     */
    private $response;

    /**
     * Form constructor.
     * @param Template $template
     * @param Response $response
     */
    public function __construct(Template $template, Response $response)
    {
        $this->template = $template;
        $this->response = $response;
    }

    public function execute()
    {
        if(Session::has('username')) {
            $this->response->redirect('/');
        }
        $this->template->setBody('Customer\Views\login');
        $this->template->render();
    }
}
