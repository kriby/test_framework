<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/21/2015
 * Time: 10:25
 */
namespace App\Customer\Actions;

use \App\Lib\Request\RequestObject;
use App\Customer\Models\Customer;

class Login
{
    /**
     * @var Customer
     */
    private $customerModel;

    /**
     * Form constructor.
     *
     * @param Customer $customer
     * @param RequestObject $requestObject
     */
    public function __construct(Customer $customer, RequestObject $requestObject)
    {
        $this->email = $requestObject->getPost('email');
        $this->password = $requestObject->getPost('password');
        $this->customerModel = $customer;
    }
}