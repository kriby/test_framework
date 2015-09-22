<?php
namespace App\Customer\View;

class Collage
{
    /**
     * Method renders a collage
     * @param $collage
     */
    public function render($collage)
    {
        header('Content-Type: image/jpeg');
        imagepng($collage);
    }
}