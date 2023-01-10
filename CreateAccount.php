<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>CreateAccount</title>
</head>
<body class="bg-[#F5F6F7]">
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

            /*create album 2 default album */
            $connection = new Connection();
            $connection->login($_POST['email'], $_POST['password']);

            require_once 'album.php';


                $album = new Album(
                    "Listes d'envie",
                    "Dans cet album vous pouvez ajouter des films a votre liste d'envie",
                    0,
                    $_SESSION['id']
                );

                    $connection_album1 = new Connection();
                    $connection_album1->insert_default_album($album);

                $album2 = new Album(
                    "Visionnes",
                    "Dans cet album vous pouvez ajouter les films que vous avez visionné",
                    0,
                    $_SESSION['id']
                );

                $connection_album2 = new Connection();
                $connection_album2->insert_default_album($album2);





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