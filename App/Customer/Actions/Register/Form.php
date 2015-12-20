<?php

namespace App\Customer\Actions\Register;


use App\Db\Connection;
use App\Lib\Action\ActionInterface;

class Form implements ActionInterface
{
    private $email;
    private $password;
    private $passwordConfirm;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return null
     */
    public function getPassword()
    {
        return $this->hashPassword();
    }

    public function __construct(Connection $connection)
    {
        if($_POST) {
            $this->email = isset($_POST['email']) ? $_POST['email'] : null;
            $this->password = isset($_POST['password']) ? $_POST['password'] : null;
            $this->passwordConfirm = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;
        }
        $this->connection = Connection ::getInstance();
    }

    /**
     *  Validates user input in Register from and saves customer into database.
     */
    public function execute()
    {
        if($this->validate()) {
            $db = $this->connection->getConnection();
            $email = $db->quote($this->getEmail());
            $password = $db->quote($this->getPassword());
            $res = $db->query("SELECT * FROM users WHERE email = {$email}");
            if ($res) {
                $msg = 'Such user already exists!';
            } else {
                $db->query("INSERT INTO users (email, user_password) VALUES ({$email},{$password})");
            }
        }
    }

    /**
     * Validates user input.
     *
     * @return bool
     */
    private function validate()
    {
        return $this->password == $this->passwordConfirm;
    }

    private function hashPassword()
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }
}
