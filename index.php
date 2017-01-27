<?php
 if(
     !isset($_GET['login']) &&
     !isset($_GET['register'])
 ) {
     header("Location: ?login");
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
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 300px;
        }

        form {
            padding: 15px;

            -webkit-box-shadow: 2px 4px 14px 5px rgba(0,0,0,0.55);
            -moz-box-shadow: 2px 4px 14px 5px rgba(0,0,0,0.55);
            box-shadow: 2px 4px 14px 5px rgba(0,0,0,0.55);
        }

        input {
            padding: 5px;
            margin: 10px;
        }

        input:focus {
            box-shadow: 1px 2px 5px 3px rgba(81, 203, 238, 1);
            border: 1px solid rgba(81, 203, 238, 1);
        }

        .btn {
            display: block;
            text-align: end;
            padding-top: 15px;
        }

        a {
            cursor: pointer;
        }

        .auth--form__button {
            -moz-box-shadow:inset 0px 1px 0px 0px #9fb4f2;
            -webkit-box-shadow:inset 0px 1px 0px 0px #9fb4f2;
            box-shadow:inset 0px 1px 0px 0px #9fb4f2;
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #7892c2), color-stop(1, #476e9e));
            background:-moz-linear-gradient(top, #7892c2 5%, #476e9e 100%);
            background:-webkit-linear-gradient(top, #7892c2 5%, #476e9e 100%);
            background:-o-linear-gradient(top, #7892c2 5%, #476e9e 100%);
            background:-ms-linear-gradient(top, #7892c2 5%, #476e9e 100%);
            background:linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#7892c2', endColorstr='#476e9e',GradientType=0);
            background-color:#7892c2;
            border:1px solid #4e6096;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:Arial;
            font-size:14px;
            font-weight:bold;
            padding:5px 32px;
            text-decoration:none;
            text-shadow:0px 1px 0px #283966;
        }
        .auth--form__button:hover {
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #476e9e), color-stop(1, #7892c2));
            background:-moz-linear-gradient(top, #476e9e 5%, #7892c2 100%);
            background:-webkit-linear-gradient(top, #476e9e 5%, #7892c2 100%);
            background:-o-linear-gradient(top, #476e9e 5%, #7892c2 100%);
            background:-ms-linear-gradient(top, #476e9e 5%, #7892c2 100%);
            background:linear-gradient(to bottom, #476e9e 5%, #7892c2 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#476e9e', endColorstr='#7892c2',GradientType=0);
            background-color:#476e9e;
        }
        .auth--form__button:active {
            position:relative;
            top:1px;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php
            if(isset($_GET['login'])) {

                echo <<<LOGIN
                <form action="src/handler.php?login" method="post">
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
            } else if(isset($_GET['register'])) {

                echo <<<REGISTER
                <form action="src/handler.php?register" method="post">
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