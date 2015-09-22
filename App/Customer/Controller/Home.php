<?php
namespace App\Customer\Controller;

use App\Customer\Model\Collage;
use App\Customer\View\Collage as CollageView;

class Home
{
    /**
     * @var \App\Customer\Model\Collage
     */
    private $collage;

    /**
     * @var CollageView
     */
    private $collageView;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $width;


    public function __construct()
    {
        $this->height = 400;
        $this->width = 200;
    }

    public function execute()
    {
        $this->collage = new Collage();
        $this->collageView = new CollageView();
        $collage = $this->collage->drawCollage($this->height, $this->width);
        $this->collageView->render($collage);

    }
}