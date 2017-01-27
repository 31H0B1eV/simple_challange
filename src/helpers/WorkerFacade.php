<?php

namespace App\helpers;

use App\helpers\User;
use App\helpers\DBHelper;


class WorkerFacade
{
    protected $user;
    protected $db;

    public function registerUser()
    {
        if(!$this->getDb()->checkRecord($this->getUser())) {
            $this->getDb()->insertRecord($this->getUser());
            header("Location: /?login&registration=success");
            exit();
        } else {
            return header("Location: /?login&registration=fail_user_exists");
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