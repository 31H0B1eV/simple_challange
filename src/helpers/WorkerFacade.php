<?php

namespace App\helpers;

class WorkerFacade
{
    protected $user;
    protected $db;

    public function registerUser()
    {
        if(!$this->getDb()->getRecord($this->getUser())) {
            if($this->getUser()->getAge() < 5) {
                header("Location: /?register&error=fail_user_low_age");
                exit();
            } else if($this->getUser()->getAge() > 150) {
                header("Location: /?register&error=fail_user_high_age");
                exit();
            }

            $this->getDb()->insertRecord($this->getUser());

            header("Location: /?login&registration=success");
            exit();
        } else {
            return header("Location: /?register&registration=fail_user_exists");
        }
    }

    public function login($password)
    {
        $record_with_correct_login = $this->getDb()->getRecord($this->getUser());

        if($record_with_correct_login) {
            if(password_verify($password, $record_with_correct_login['password'])) {
                setcookie('login', "success", time()+60*60*24*365, '/');
                $_COOKIE['login'] = "success";

                header("Location: /?login=success");
                exit();
            } else {
                header("Location: /?login=fail");
                exit();
            }
        }
    }

    /**
     * Worker constructor.
     * @param $user
     * @param $db
     */
    public function __construct(User $user, DBHelper $db)
    {
        $this->user = $user;
        $this->db = $db;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return DBHelper
     */
    public function getDb()
    {
        return $this->db;
    }
}