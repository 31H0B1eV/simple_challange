<?php

function __autoload($className) {
    include __DIR__ . '/helpers/' . $className . '.php';
}

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
                    cleanUpInput($_POST['login']),
                    password_hash(cleanUpInput($_POST['password']), PASSWORD_DEFAULT),
                    (int) getAge($_POST['birthday'])
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

/**
 * As named return user age from birthday
 *
 * @param $birthday
 * @return int
 */
function getAge($birthday) {
    $date = new DateTime(cleanUpInput($birthday));
    $now = new DateTime();
    $interval = $now->diff($date);

    return $interval->y;
}

/**
 * Remove spaces from start and end,
 * convert special chars into html
 * and remove them.
 *
 * @param $value
 * @return string
 */
function cleanUpInput($value) {
    return strip_tags(htmlspecialchars(trim($value)));
}