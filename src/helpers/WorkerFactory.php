<?php

namespace App\helpers;


class WorkerFactory
{

    protected $facade;

    /**
     * @return WorkerFacade
     */
    public function getFacade()
    {
        return $this->facade;
    }

    /**
     * WorkerFactory constructor.
     * @param $login
     * @param $password
     * @param $age
     */
    public function __construct($login, $password, $age=0)
    {
        if(func_num_args() == 2) {
            $this->facade = new WorkerFacade(
                new User(
                    Helpers::cleanUpInput($login),
                    password_hash(Helpers::cleanUpInput($password), PASSWORD_DEFAULT)
                ),
                new DBHelper()
            );
        } else {
            $this->facade = new WorkerFacade(
                new User(
                    Helpers::cleanUpInput($login),
                    password_hash(Helpers::cleanUpInput($password), PASSWORD_DEFAULT),
                    (int) Helpers::getAge($age)
                ),
                new DBHelper()
            );
        }
    }
}