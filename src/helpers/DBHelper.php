<?php

namespace App\helpers;

use PDO;

class DBHelper
{
    protected $config;

    protected $host;
    protected $db;
    protected $user;
    protected $pass;
    protected $charset;

    public function __construct()
    {
        $this->setConfig(parse_ini_file(__DIR__ . '/../../.env.ini'));
        $this->host = $this->config['host'];
        $this->db = $this->config['database'];
        $this->user = $this->config['username'];
        $this->pass = $this->config['password'];
        $this->charset = $this->config['charset'];

        $this->init(); // create users table if not exists
    }


    public function getConnection()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, $this->user, $this->pass, $opt);

        return $pdo;
    }

    public function init()
    {
        $pdo = $this->getConnection();

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `users` (
              `user_id` INT NOT NULL AUTO_INCREMENT,
              `login` VARCHAR(80) NOT NULL,
              `age` INT NOT NULL,
              `counter` INT NOT NULL,
              `password` CHAR(128) NOT NULL,
              PRIMARY KEY (`user_id`),
              UNIQUE INDEX (`login`)
            ) ENGINE=INNODB;
        ");
    }

    public function getAll()
    {
        $conn = $this->getConnection();

        return $conn->query("
            SELECT * FROM `users`
        ")->fetchAll();
    }

    public function getRecord(User $user)
    {
        $conn = $this->getConnection();
        $login = $user->getLogin();

        return $conn->query("
            SELECT * FROM `users`
            WHERE `login` = '$login'
        ")->fetch();
    }

    public function insertRecord(User $user)
    {
        $conn = $this->getConnection();
        $login = $user->getLogin();
        $password = $user->getPassword();
        $age = $user->getAge();

        return $conn->exec("
            INSERT INTO `users` (`login`, `password`, `age`, `counter`)
            VALUES ('$login', '$password', '$age', 0)
        ");
    }

    public function increment(User $user)
    {
        $conn = $this->getConnection();
        $login = $user->getLogin();

        return $conn->query("
            UPDATE `users` 
            SET `counter`=`counter` + 1
            WHERE `login`='$login'
        ");
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }
}