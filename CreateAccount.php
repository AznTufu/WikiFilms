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
    <h1 class="flex justify-center text-4xl font-bold pt-14">Wikifilms</h1>
    <div class="flex justify-center items-center my-4 lg:my-5">
        <div class="shadow-lg flex flex-col justify-end items-center mx-4 my-4 lg:my-12 w-[450px] h-[650px] bg-white rounded-[30px] xl:w-[550px] xl:h-[600px]">
            <h2 class="flex justify-center text-3xl lg:text-4xl font-bold py-8">Create an account</h2>
            <form method="POST">
                <div class="flex justify-center flex-col lg:flex-row lg:gap-4">
                    <input class="px-6 py-0 gap-2.5 my-2 w-[275px] h-[56px] border-[#333] border-2 rounded-[30px] xl:w-[180px] xl:mr-4" type="text" name="firstname" placeholder="First name" required>
                    <input class="px-6 py-0 gap-2.5 my-2 w-[275px] h-[56px] border-[#333] border-2 rounded-[30px] xl:w-[180px] xl:mr-4" type="text" name="lastname" placeholder="Last name" required>
                </div>
                <div class="flex flex-col items-center">
                    <input class="px-6 py-0 gap-2.5 my-2 w-[275px] h-[56px] border-[#333] border-2 rounded-[30px] xl:w-[400px] xl:mr-4" type="text" name="username" placeholder="Username" required>
                    <input class="px-6 py-0 gap-2.5 my-2 w-[275px] h-[56px] border-[#333] border-2 rounded-[30px] xl:w-[400px] xl:mr-4" type="email" name="email" placeholder="Email">
                    <input class="px-6 py-0 gap-2.5 my-2 w-[275px] h-[56px] border-[#333] border-2 rounded-[30px] xl:w-[400px] xl:mr-4" type="password" name="password" placeholder="Password">
                    <input class="px-6 py-0 gap-2.5 mt-2 w-[275px] h-[56px] border-[#333] border-2 rounded-[30px] xl:w-[400px] xl:mr-4" type="password" name="password2" placeholder="Retype password">   
                    <input class="justify-center px-6 py-0 gap-2.5 my-8 w-[275px] h-[56px] bg-[#F3EDFB] rounded-[30px] xl:w-[400px] xl:mr-4 shadow-md" type="submit" value="Register" name="Register">
                </div>
            </form> 
        </div>
    </div>
    <div class="flex justify-center text-2xl font-bold py-2 lg:pb-7">
        <a href="login.php">Already a member? Sign in</a>
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
            
            header("location: login.php");

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





            // header("location: login.php");
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