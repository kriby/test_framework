<?php

namespace App\Customer\Actions\Register;

use App\Customer\Models\Customer;
use App\Lib\Action\ActionInterface;
use App\Lib\Response\Response;

class Form implements ActionInterface
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
     *  Validates user input in Register form and saves customer into database.
     */
    public function execute()
    {
        if ($this->validate()) {
            $this->customer->save();
            $this->response->redirect('/');
        } else {
            throw new \Exception('Password and Confirm Password fields should be the same.');
        }
    }

    /**
     * Validates user input.
     *
     * @return bool
     */
    private function validate()
    {
        return $this->customer->getPassword() === $this->customer->getPasswordConfirm();
    }
}
