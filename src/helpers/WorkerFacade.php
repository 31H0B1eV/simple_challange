<?php
/**
 * Mainly class simplifier inspired by Facade design pattern from GOF.
 *
 * it takes all from User and DBHelper classes and make using their functionality
 * in easy way without unnecessary info
 */
namespace App\helpers;

class WorkerFacade
{
    protected $user;
    protected $db;

    /**
     * Main registration form logic
     */
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

    /**
     * Main login form logic
     * already have correct user login and check password value
     *
     * @param $password
     */
    public function login($password)
    {
        $record_with_correct_login = $this->getDb()->getRecord($this->getUser());

        if($record_with_correct_login) {
            if(password_verify($password, $record_with_correct_login['password'])) {
                setcookie('login', serialize($this->getUser()), time()+60*60*24*365, '/');
                $_COOKIE['login'] = serialize($this->getUser());

                setcookie('userCounter', $record_with_correct_login['counter'], time()+60*60*24*365, '/');
                $_COOKIE['userCounter'] = $record_with_correct_login['counter'];

                header("Location: /?login=success");
                exit();
            } else {
                header("Location: /?login=fail");
                exit();
            }
        }
    }

    /**
     * Method just for consistency
     * simply want to have all required workers in this class
     *
     * @return mixed
     */
    public function callIncrement()
    {
        $this->getDb()->increment($this->getUser());

        return $this->getDb()->getRecord($this->getUser())['counter'];
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