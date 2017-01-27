<?php

namespace App\helpers;


class WorkerFacade
{
    protected $user;
    protected $db;

    public function registerUser()
    {
        if(!$this->getDb()->getRecord($this->getUser())) {
            $this->getDb()->insertRecord($this->getUser());
            header("Location: /?login&registration=success");
            exit();
        } else {
            return header("Location: /?login&registration=fail_user_exists");
        }
    }

    public function login($password)
    {
        $record_with_correct_login = $this->getDb()->getRecord($this->getUser());

        if($record_with_correct_login) {
            if(password_verify($password, $record_with_correct_login['password'])) {
                header("Location: /?login=success");
                exit();
            } else {
                header("Location: /?login=fail");
                exit();
            }
        } else {
            header("Location: /?login=fail&reason=wrong_login");
            exit();
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