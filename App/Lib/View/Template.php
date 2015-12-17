<?php
namespace App\Lib\View;

class Template implements TemplateInterface
{
    const DEFAULT_TEMPLATE = '..\default.phtml';

    protected $template = self::DEFAULT_TEMPLATE;
    protected $body;

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    public function getTemplate()
    {
        return $this->template ;
    }

    public function getBody($value, $dir)
    {
        ob_start();
        include $dir . DS . '..' . DS . 'Views'. DS . $value . '.phtml';
        $this->body = ob_get_clean();
    }

    public function render()
    {
        include  __DIR__ . DS. $this->getTemplate();
    }
}