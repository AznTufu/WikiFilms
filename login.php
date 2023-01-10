<?php 
require_once 'vendor/autoload.php';
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Login</title>
</head>
<body class="bg-[#F5F6F7]">
    <h1 class="flex justify-center text-4xl font-bold pt-14">Wikifilms</h1>
    <div class="flex justify-center items-center my-4 lg:my-5">
        <div class="shadow-lg flex flex-col justify-end items-center mx-4 my-4 lg:my-12 w-[450px] h-[410px] bg-white rounded-[30px] xl:w-[550px] xl:h-[440px]">
            <h2 class="flex justify-center text-4xl font-bold py-8">Login</h2>
            <form method="POST" name="login">
                <input class="flex justify-center px-6 py-0 gap-2.5 my-4 w-[275px] h-[56px] border-[#333] border-2 rounded-[30px] xl:w-[400px] xl:mr-4" type="email" name="email" placeholder="Email">
                <input class="flex justify-center px-6 py-0 gap-2.5 w-[275px] h-[56px] border-[#333] border-2 rounded-[30px] xl:w-[400px] xl:mr-4" type="password" name="password" placeholder="password">   
                <input class="flex justify-center px-6 py-0 gap-2.5 my-12 w-[275px] h-[56px] bg-[#F3EDFB] rounded-[30px] xl:w-[400px] xl:mr-4 shadow-md" type="submit" value="Sign in" name="Sign in">
            </form> 
        </div>
    </div>
    <div class="flex justify-center text-2xl font-bold py-2 lg:pb-7">
        <a href="CreateAccount.php">Not a member? Sign up now</a>
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
    } else { ?>
    <h3 class="flex justify-center text-xl lg:text-2xl font-bold py-2 lg:py-0">Email or password not valid</h3>
    <?php }
} ?>