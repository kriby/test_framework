<?php

namespace App\Customer\Actions\Register;

use App\Customer\Models\Customer;
use App\Lib\Action\ActionInterface;
use App\Lib\Session\Session;

class Form implements ActionInterface
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
            $this->username = isset($_POST['user_name']) ? $_POST['user_name'] : null;
            $this->email = isset($_POST['email']) ? $_POST['email'] : null;
            $this->password = isset($_POST['password']) ? $_POST['password'] : null;
            $this->passwordConfirm = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
        }
        $this->customerModel = $customer;
    }

    /**
     *  Validates user input in Register from and saves customer into database.
     */
    public function execute()
    {
        $this->customerModel->saveCustomer($this->username, $this->email, $this->password, $this->passwordConfirm);
        header('location: /home');
    }
}
