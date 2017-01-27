<?php
require "../vendor/autoload.php";

use App\helpers\User;
use App\helpers\Helpers;
use App\helpers\DBHelper;
use App\helpers\WorkerFacade;

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    if(isset($_GET['login'])) {
        if($_POST['login'] && $_POST['password']) {

        }
    } else if(isset($_GET['register'])) {
        if(
            $_POST['login'] &&
            $_POST['password'] &&
            $_POST['birthday']
        ) {

            $job = new WorkerFacade(
                new User(
                    Helpers::cleanUpInput($_POST['login']),
                    password_hash(Helpers::cleanUpInput($_POST['password']), PASSWORD_DEFAULT),
                    (int) Helpers::getAge($_POST['birthday'])
                ),
                new DBHelper()
            );

            $job->registerUser();

        } else {
            header("Location: /?login&registration=fail_with_passing_data");
        }
    }
} else {
    echo "Wrong request method: " . $_SERVER['REQUEST_METHOD'];
}