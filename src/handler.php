<?php
require "../vendor/autoload.php";

use App\helpers\User;
use App\helpers\Helpers;
use App\helpers\DBHelper;
use App\helpers\WorkerFacade;
use App\helpers\WorkerFactory;

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    if(isset($_GET['login'])) {
        if($_POST['login'] && $_POST['password']) {

            $job = new WorkerFactory($_POST['login'], $_POST['password']);

            $job->getFacade()->login(Helpers::cleanUpInput($_POST['password']));
        }
    } else if(isset($_GET['register'])) {
        if(
            $_POST['login'] &&
            $_POST['password'] &&
            $_POST['birthday']
        ) {

            $job = new WorkerFactory($_POST['login'], $_POST['password']);

            $job->getFacade()->registerUser();

        } else {
            header("Location: /?login&registration=fail_with_passing_data");
        }
    }
} else {
    echo "Wrong request method: " . $_SERVER['REQUEST_METHOD'];
}