<?php
namespace App\Lib\View;

interface TemplateInterface
{
    public function render();

    public function setTemplate($template);

    public function getTemplate();
}