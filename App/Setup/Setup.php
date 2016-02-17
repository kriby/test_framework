<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 17.02.2016
 * Time: 21:37
 */

namespace App\Setup;

use App\Install;
use App\Lib\Action\ActionInterface;

class Setup implements ActionInterface
{
    /**
     * @var Install
     */
    private $install;

    /**
     * Install constructor.
     * @param Install $install
     */
    public function __construct(Install $install)
    {
        $this->install = $install;
    }

    public function execute()
    {
        $this->install->install();
    }
}
