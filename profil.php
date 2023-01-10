<?php use FilmApi\FilmApi;
require_once 'vendor/autoload.php';
session_start() ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="css/main.css">
    <title>Profile</title>
</head>
<body class="bg-[#F5F6F7]">

<section class="sticky bg-white shadow-lg border-current mb-8">
    <div class="flex items-center justify-between pl-8 pr-8 xl:pl-36 py-2 px-1 max-w-[1800px]">
        <a href="index.php" class="w-[50px] lg:w-[100px] ml-8 xl:ml-24 2xl:ml-34"><img src="img/logo.png" alt="logo"></a>
        <div>
            <a href="profil.php" class="text-lg lg:text-2xl font-semibold text-[#333] mr-6 lg:mr-10"><?php echo $_SESSION['name'] ?></a>
            <a href="login.php"><i class="fa-solid fa-right-from-bracket sm:mr-6 lg:mr-8 xl:mr-10 text-xl"></i></a>
        </div>
    </div>
</section>

<div>
    <div class="flex justify-center items-center my-4 lg:my-5">
        <div class="shadow-lg flex flex-col justify-end items-center mx-4 my-4 lg:my-12 w-[450px] h-[450px] bg-white rounded-[30px] xl:w-[550px] xl:h-[480px]">
            <h1 class="flex justify-center text-4xl font-bold py-8">Ajout d'album</h1>
            <form method="POST">
                <input class="flex justify-center px-6 py-0 gap-2.5 my-4 w-[275px] h-[56px] border-[#333] border-2 rounded-[30px] xl:w-[400px] xl:mr-4" type="text" name="name" placeholder="Ex: album numéro°46" required>
                <input class="flex justify-center px-6 py-0 gap-2.5 mb-4 w-[275px] h-[56px] border-[#333] border-2 rounded-[30px] xl:w-[400px] xl:mr-4" type="text" name="description" placeholder="Une description de l'album" required>
                <select class="flex justify-center px-6 py-0 gap-2.5 w-[275px] h-[56px] border-[#333] border-2 rounded-[20px] xl:w-[400px] xl:mr-4" name="private">
                    <option value="prive">Privée</option>
                    <option value="public">Public</option>
                </select>   
                <input class="flex justify-center px-6 py-0 gap-2.5 my-12 w-[275px] h-[56px] bg-[#F3EDFB] rounded-[30px] xl:w-[400px] xl:mr-4 shadow-md" type="submit" value="Enregistrer un nouvel album">
            </form> 
        </div>
    </div>
</div>

<?php
require_once 'album.php';
require_once 'Connection.php';


if($_POST){
    $album = new Album(
        $_POST['name'],
        $_POST['description'],
        $_POST['private'],
        $_SESSION['id'],
    );

    if($album->verify()){
        $connection = new Connection();
        $result = $connection->insert_album($album);
        if ($result){
            echo 'Great ! We Create your album.';
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
<section>
    <?php
    $user_id=$_SESSION['id'];
    $connection = new Connection();
    $result_album = $connection->show_album($user_id);

    if($result_album==Null){ ?>
        <h3 class="flex justify-center text-xl lg:text-2xl font-bold py-2 lg:py-0">Vous n'avez pas encore créé d'album.</h3>
    <?php }
    else{ ?>
        <h2 class="flex justify-center text-4xl font-bold py-8">Vos album</h2>
        <div class="flex flex-col lg:flex-row justify-center items-center gap-8 pb-4">
            <?php
            foreach ($result_album as $album_data) { ?>
            <div class="shadow-lg flex flex-col justify-start items-center pt-10 bg-white rounded-[30px] w-[250px] h-[250px]">
                <div class="flex justify-center text-xl lg:text-2xl font-bold pb-3"><?php echo $album_data["name"];?></div>
                <div class="px-6 py-4"><?php echo $album_data["description"];?></div>
                <div><?php echo $album_data["private"];?></div>
            </div>
            <?php } ?>
        </div>
    <?php } ?>
</section>

<section>
    <div class="flex flex-col lg:flex-row justify-between items-center mt-[5rem] mx-auto pb-[10vh] border-t-4 border-[#333] text-lg text-[#333] max-w-[300px] sm:max-w-[700px] lg:max-w-[1600px]">
        <div class="mt-4"> @2022-2023 </div>
        <div> Tony Zhang & Romain Parisot</div>
        <div><a href="https://github.com/AznTufu/WikiFilms" target="_blank">Github</a></div>
    </div>
</section>
</body>
</html>