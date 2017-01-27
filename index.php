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
    </style>
</head>
<body>

    <div class="container">
        <?php
            if(isset($_GET['login'])) {

                echo <<<LOGIN
                <form action="src/helper.php" method="post">
                    <div>
                        <input type="text" name="login" placeholder="login">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="password">
                    </div>

                    <div>
                        <div class="btn">
                            <button type="submit">login</button>
                        </div>
                        <div class="btn">
                            <a class="button" href="?register">Don't have account?</a>
                        </div>
                    </div>
                </form>
LOGIN;
            } else if(isset($_GET['register'])) {

                echo <<<REGISTER
                <form action="src/helper.php" method="post">
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
                            <button type="submit">register</button>
                        </div>
                        <div class="btn">
                            <a class="button" href="?login">Back to login.</a>
                        </div>
                    </div>
                </form>
REGISTER;
            }
        ?>
    </div>

</body>
</html>