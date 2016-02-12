<?php

namespace App\Customer\Actions\Register;

use App\Customer\Models\Customer;
use App\Lib\Action\ActionInterface;

class Form implements ActionInterface
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

    /**
     *  Validates user input in Register from and saves customer into database.
     */
    public function execute()
    {
        if ($this->validate($this->customer->password, $this->customer->passwordConfirm)) {
            $this->customer->save();
            //header('location: /home');

            return $this->response->redirect($this->urlBuilder->getUrl('/home'));
        }






    }

    /**
     * Validates user input.
     *
     * @param $password
     * @param $passwordConfirm
     * @return bool
     */
    private function validate($password, $passwordConfirm)
    {
        return $password == $passwordConfirm;
    }
}
