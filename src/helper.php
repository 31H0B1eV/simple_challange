<?php
if($_SERVER["REQUEST_METHOD"] == 'POST') {
    if($_POST['login'] && $_POST['password']) {

        var_dump($_POST);
    }
} else {
    echo $_SERVER['REQUEST_METHOD'];
}