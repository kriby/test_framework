<?php
namespace App\Lib\View;

class Template implements TemplateInterface
{
    const DEFAULT_TEMPLATE = '..' . DS . 'default.phtml';

    protected $headerLogin = '';
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

    public function setBody($value)
    {
        ob_start();
        include ROOT . DS . 'App' . DS . str_replace('/', DS, $value) . '.phtml';
        $this->body = ob_get_clean();
    }

    public function setHeaderLogin($value, $dir)
    {
        ob_start();
        include $dir . DS . '..' . DS . 'Views'. DS . $value . '.phtml';
        $this->headerLogin = ob_get_clean();
    }

    public function render()
    {
        include  __DIR__ . DS. $this->getTemplate();
    }
}
