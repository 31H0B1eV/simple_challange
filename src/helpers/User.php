<?php

namespace App\helpers;

class User
{
    private $login;
    private $password;
    private $age;

    /**
     * User constructor.
     *
     * @param $login
     * @param $password
     * @param $age
     */
    public function __construct($login, $password, $age=0)
    {
        $this->login = $login;
        $this->password = $password;
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }


}