<?php
/**
 * Mainly class creator inspired by Factory design pattern from GOF.
 *
 * create WorkerFacade instance based on passed parameters
 */

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
            $this->facade = new WorkerFacade( // used in login form handling
                new User(
                    Helpers::cleanUpInput($login),
                    password_hash(Helpers::cleanUpInput($password), PASSWORD_DEFAULT)
                ),
                new DBHelper()
            );
        } else {
            $this->facade = new WorkerFacade( // used in registration form handling
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