<?php session_start(); ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Login</title>
    </head>
    <body>
    <h1>WikiFilm</h1>
    <div>
        <h2>Log In</h2>
        <form method="POST" name="login">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="submit" value="Submit" name="submit">
        </form>
    </div>


    </body>
    </html>

<?php
require_once 'user.php';
require_once 'Connection.php';

if($_POST){
    $email = stripslashes($_POST['email']);
    $password = stripslashes($_POST['password']);
    $connection = new Connection();
    $test=$connection->login($email, $password);

    if($test){
        $_SESSION['user_type'] = 'User' ;
        header("Location: index.php");
        echo "utilisateur trouvé";

    }else{
        echo "Email or password not valid";
    }
}



?>