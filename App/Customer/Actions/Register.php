<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/12/2015
 * Time: 20:02
 */

namespace App\Customer\Actions;

use App\Lib\Action\ActionInterface;
use App\Lib\View\Template;


class Register implements ActionInterface
{
    private $template;

    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    public function execute()
    {
        $this->template->setBody('register', __DIR__);
        $this->template->render();
    }
}
