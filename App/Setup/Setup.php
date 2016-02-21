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
use App\Lib\Response\Response;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Setup implements ActionInterface
{
    /**
     * @var Install
     */
    private $install;

    /**
     * @var Logger
     */
    private $logger;
    /**
     * @var Response
     */
    private $response;

    /**
     * Install constructor.
     * @param Install $install
     * @param Response $response
     */
    public function __construct(Install $install, Response $response)
    {
        $this->install = $install;
        // create a log channel
        $this->logger = new Logger('name');
        $this->logger->pushHandler(new StreamHandler(ROOT . DS . 'error.log', Logger::WARNING));
        $this->response = $response;
    }

    public function execute()
    {
        try {
            $this->install->install();
        } catch (\Exception $e) {
            $this->logger->error($e->getTraceAsString());
            echo $e->getMessage();
        }
        $this->response->redirect('/');
    }
}
