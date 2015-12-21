<?php
/**
 * Created by PhpStorm.
 * User: rliukshyn
 * Date: 12/21/2015
 * Time: 10:25
 */

namespace App\Customer\Actions;


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
     */
    public function __construct(Customer $customer)
    {
        if($_POST) {
            $this->email = isset($_POST['email']) ? $_POST['email'] : null;
            $this->password = isset($_POST['password']) ? $_POST['password'] : null;
        }
        $this->customerModel = $customer;
    }

    /**
     *  Validates user input in Register from and saves customer into database.
     */
    public function execute()
    {
        $this->customerModel->getCustomer($this->email, $this->password);
    }
}