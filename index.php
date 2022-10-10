<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") { //тут воо
if($_POST['submit']) {
    if(strtolower($_POST['captcha'])== $_SESSION['captcha']) {
        echo "Все ОК!";
    } else {
        echo "Ошибка";
    }
}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Captcha Ha PHP</title>
        <style>
            input[name=submit]{
                background: #39b5cc;
                color: #fff;
                border-radius: 3px;
                border: none;
                padding: 6px 10px;
                margin: 10px 0 10px 0;
            }
            a{
                color: #000;
            }
        </style>
    </head>
    <body>
        <form method="post" action="">
            <input type="text" name="name_text" placeholder="Hello!"><br>
            <img src="captcha.php"></br>
            <input type="text" name="captcha" placeholder="Введите символы!"><br>

            <input type="submit" name="submit" value="Отправить"><br>
        </form>
    </body>
    <a href="demo.php">Free to use ^_^</a>
</html>