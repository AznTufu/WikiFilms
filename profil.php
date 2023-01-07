<?php use FilmApi\FilmApi;
require_once 'vendor/autoload.php';

session_start() ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Profile</title>
</head>
<body>

<div>
    <form method="POST">

        <label for="">Entrer le nom de votre album</label>
        <input type="text" name="name" placeholder="Album numéro 46">
        <label for="">Ajouter une description a votre album</label>
        <input type="text" name="description" placeholder="Ma description">
        <label for="">L'album doit-il être privée ou public ?</label>
        <select name="private" id="">
            <option value="prive">Privée</option>
            <option value="public">Public</option>
        </select>

        <input type="submit">
    </form>

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

</body>
