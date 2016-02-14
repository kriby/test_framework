<?php
namespace App\Customer\Actions\Login;

use App\Lib\Action\ActionInterface;
use App\Lib\View\Template;

class Form implements ActionInterface
{
    private $template;

    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    public function execute()
    {
        $this->template->setBody('login', __DIR__);
        $this->template->render();
    }
}
