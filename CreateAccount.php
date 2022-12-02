<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>CreateAccount</title>
</head>
<body>
<h1>WikiFilm</h1>
<div>
    <div>
        <h2>Create a Account</h2>
        <form method="POST" >
            <input type="text" name="firstname" placeholder="First name" required>
            <input type="text" name="lastname" placeholder="Last name" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="password" name="password2" placeholder="retype password">
            <input type="submit" value="Submit" >
        </form>
    </div>
</div>


</body>
</html>

<?php
require_once 'user.php';
require_once 'Connection.php';


if($_POST){
    $user = new User(
        $_POST['email'],
        $_POST['password'],
        $_POST['password2'],
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['username']
    );

    if($user->verify()){
        $connection = new Connection();
        $result = $connection->insert($user);
        if ($result){
            echo 'Great ! We Create a account with your data.';
            header("location: login.php");
        }
        else{
            echo 'Database error';
        }
    }
    else{
        echo 'Form error';
    }
}

?>