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

class Login implements ActionInterface
{
    /**
     * @var Customer
     */
    private $customer;

    /**
     * Form constructor.
     *
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function execute()
    {
        try {
            $this->customer->getCustomer();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
