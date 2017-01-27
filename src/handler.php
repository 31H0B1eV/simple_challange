<?php
if($_SERVER["REQUEST_METHOD"] == 'POST') {
    if($_POST['login'] && $_POST['password']) {

        $login = cleanUpInput($_POST['login']);
        $password = cleanUpInput($_POST['password']);

        echo $login . ' | ' . $password;
    } else {
        echo "something wrong";
    }
} else {
    echo $_SERVER['REQUEST_METHOD'];
}

function cleanUpInput($value) {
    return strip_tags(htmlspecialchars(trim($value)));
}