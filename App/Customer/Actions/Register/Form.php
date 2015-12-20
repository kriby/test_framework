<?php

namespace App\Customer\Actions\Register;

use App\Customer\Models\Save;
use App\Lib\Action\ActionInterface;

class Form implements ActionInterface
{
    /**
     * @var Save
     */
    private $saveModel;

    /**
     * Form constructor.
     *
     * @param Save $saveModel
     */
    public function __construct(Save $saveModel)
    {
        if($_POST) {
            $this->email = isset($_POST['email']) ? $_POST['email'] : null;
            $this->password = isset($_POST['password']) ? $_POST['password'] : null;
            $this->passwordConfirm = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
        }
        $this->saveModel = $saveModel;
    }

    /**
     *  Validates user input in Register from and saves customer into database.
     */
    public function execute()
    {
        $this->saveModel->saveCustomer($this->email, $this->password, $this->passwordConfirm);
    }
}
