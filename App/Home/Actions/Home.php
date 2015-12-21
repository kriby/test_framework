<?php

namespace App\Home\Actions;

use App\Lib\View\Template;
use App\Lib\Action\ActionInterface;

class Home implements ActionInterface
{
    private $template;

    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    public function execute()
    {
        $this->template->setBody('home', __DIR__);
        $this->template->render();
    }
}