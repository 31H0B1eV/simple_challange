<?php
if(
    !isset($_COOKIE['login']) &&
    !isset($_GET['login']) &&
    !isset($_GET['register'])
) {
    header("Location: ?login");
    exit();

} else if(isset($_GET['registration'])) {
    echo $_GET['registration'];

} else if(isset($_GET['error'])) {
    echo $_GET['error'];

} else if(isset($_GET['exit']) && isset($_COOKIE['login'])) {
    unset($_COOKIE['login']);
    setcookie('login', null, -1, '/');

    unset($_COOKIE['userCounter']);
    setcookie('userCounter', null, -1, '/');

    header("Location: ?login");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>

    <div class="container">
        <?php
            if(isset($_GET['login']) || isset($_COOKIE['login'])) {

                if($_GET['login'] != 'success' && !isset($_COOKIE['login'])) {
                    echo <<<LOGIN
                <form class='main-form' action="src/handler.php?login" method="post">
                    <div>
                        <input type="text" name="login" placeholder="login">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="password">
                    </div>
                    
                    <div>
                        <div class="btn">
                            <button class="auth--form__button" type="submit">login</button>
                        </div>
                        <div class="btn">
                            <a href="?register">Don't have account?</a>
                        </div>
                    </div>
                </form>
LOGIN;
                } else if($_COOKIE['login'] != '') {
                    $counter = 0;
                    if(isset($_COOKIE['userCounter'])) {
                        $counter = (int) $_COOKIE['userCounter'];
                    }
                        echo <<<LOGIN
                        <div class='success'>
                            <h1>$counter</h1>
                            <div class='success__buttons'>
                                <div>
                                    <form action="src/handler.php?increment" method="post">
                                        <button type='submit'>+1</button>
                                    </form>
                                </div>
                                <div>
                                    <a href="?exit">exit</a>
                                </div>
                            </div>
                        </div>
LOGIN;
                } else {
                    echo "cookie not set <a href=\"?login\">back to login</a>";
                }
            } else if(isset($_GET['register'])) {
                if($_GET['error']) {
                    $error = $_GET['error'] == 'fail_user_low_age' ? 'Too young!' : 'Too old!';
                    echo <<<ERROR
                    <div class='error'>
                        <p style='color: tomato;'>$error </p>
                    </div>
ERROR;

                }
                echo <<<REGISTER
                <form class='main-form' action="src/handler.php?register" method="post">
                    <div>
                        <input type="text" name="login" placeholder="login">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="password">
                    </div>
                    <div>
                        <input type="date" name="birthday" placeholder="birthday">
                    </div>

                    <div>
                        <div class="btn">
                            <button class="auth--form__button" type="submit">register</button>
                        </div>
                        <div class="btn">
                            <a href="?login">Back to login.</a>
                        </div>
                    </div>
                </form>
REGISTER;
            } else {
                echo "What do you want from me man?";
            }
        ?>
    </div>

</body>
</html>