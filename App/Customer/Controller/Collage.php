<?php
namespace App\Customer\Controller;

use App\Customer\Model\Collage as CollageModel;
use App\Customer\View\Collage as CollageView;

class Collage
{
    /**
     * @var CollageModel
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
        $this->collage = new CollageModel();
        $this->collageView = new CollageView();
        try {
            $collage = $this->collage->drawCollage($this->height, $this->width);
            $this->collageView->render($collage);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}