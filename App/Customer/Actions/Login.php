<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/21/2015
 * Time: 10:25
 */
namespace App\Customer\Actions;

use App\Customer\Models\Customer;
use App\Lib\Action\ActionInterface;
use App\Lib\Response\Response;

class Login implements ActionInterface
{
    /**
     * @var Customer
     */
    private $customer;
    /**
     * @var Response
     */
    private $response;

    /**
     * Form constructor.
     *
     * @param Customer $customer
     * @param Response $response
     */
    public function __construct(Customer $customer, Response $response)
    {
        $this->customer = $customer;
        $this->response = $response;
    }

    /**
     *  Logs in customer.
     */
    public function execute()
    {
        try {
            $this->customer->find();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
