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
    <title>Document</title>
</head>
<body>

<?php $film_id = $_GET["film_id"];

require_once 'FilmApi.php';

$api = new FilmApi();

$data = $api->Movie_id($film_id);
$films_ordered = json_decode($data);

?>
<div>
<?php echo $films_ordered->budget;
    echo $films_ordered->title;

    if($films_ordered->backdrop_path == Null){ ?>
    <img src="img/question_mark.jpg" alt="" >
    <?php }
    else{ ?>
    <img src=" https://image.tmdb.org/t/p/w500<?php echo $films_ordered->backdrop_path ?>" alt="" >
    <?php }

    if($films_ordered->poster_path == Null){ ?>
    <img src="img/question_mark.jpg" alt="" >
    <?php }
    else{ ?>
    <img src=" https://image.tmdb.org/t/p/w500<?php echo $films_ordered->poster_path ?>" alt="" >
    <?php }?>




</div>

<form method="POST">

    <select name="deloradd" >
        <option value="add">Ajouter</option>
        <option value="delete">Suprimer</option>
    </select>

    <label for="">Entrer le nom de l'album dans lequel vous souhaitez Ajouter/Suprimer ce film</label>
    <input type="text" name="name">

    <input type="submit">
</form>


<?php
require_once 'Movie.php';
require_once 'Connection.php';

if ($_POST){

    $connection = new Connection();
    $result_album_exist_by_name = $connection->album_exist($_POST['name'], $_SESSION['id']);


    /* Check si l'utilisateur possede un album avec ce nom */
    if($result_album_exist_by_name) {
        $connection = new Connection();
        $result_album_id = $connection->get_album_id($_POST['name'], $_SESSION['id']);


        $movie = new Movie(
            $film_id,
            $result_album_id
        );


        /* ajouter a un album */

        if ($_POST['deloradd'] == 'add') {
            if ($movie->verify()) {
                $connection = new Connection();
                $result_movie = $connection->insert_movie($movie);
                if ($result_movie) {
                    echo 'Great ! We add this film to your album.';
                } else {
                    echo 'Database error';
                }
            } else {
                echo 'Form error';
            }
        }


        /*delete d'un album */

        elseif ($_POST['deloradd'] == 'delete') {
            if ($movie->verify()) {
                $connection = new Connection();
                $result_movie_del = $connection->delete_film_in_album($film_id, $result_album_id);
                if ($result_movie_del) {
                    echo 'Great ! We delete this film to your album.';
                } else {
                    echo 'Database error';
                }
            } else {
                echo 'Form error';
            }

        } else {
            echo "Veuillez choisir dans le select Ajouter ou Supprimer.";
        }
    }
    else{
        echo "Vous n'avez aucun album avec ce nom.";
    }

}


?>



    <h3>Vos album :</h3>
    <div>
        <?php

        $user_id=$_SESSION['id'];
        $connection = new Connection();
        $result_album = $connection->show_album($user_id);

        if($result_album==Null){
            echo "Vous n'avez pas encore créer d'album. ";
        }
        else{ ?>
            <div>

                <?php

                foreach ($result_album as $album_data) {
                    echo $album_data["name"];
                    echo $album_data["description"];
                    echo $album_data["private"];
                }

                ?>
            </div>

        <?php } ?>
    </div>
</body>
