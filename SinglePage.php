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
    <title>Document</title>
</head>
<body class="bg-[#F5F6F7]">

<?php $film_id = $_GET["film_id"];

require_once 'FilmApi.php';

$api = new FilmApi();

$data = $api->Movie_id($film_id);
$films_ordered = json_decode($data);

?>
<section class="flex justify-center rounded-3xl">
    <div class="flex flex-row bg-[#17181C] text-white shadow-lg border-current rounded-lg w-[965px] lg:w-[1285px] lg:mb-12 ">
        <?php 
            if(($films_ordered->poster_path and $films_ordered->belongs_to_collection) === Null) { ?>
                <img src="img/question_mark.jpg" alt="Missing image">
            <?php } else {
                if ($films_ordered->belongs_to_collection == null) { ?>
                    <img class="rounded-l-lg" src="https://image.tmdb.org/t/p/w500<?php echo $films_ordered->poster_path ?>" alt="" >
                <?php } else { ?>
                    <img class="rounded-l-lg" src="https://image.tmdb.org/t/p/w500<?php echo $films_ordered->belongs_to_collection->poster_path; ?>" alt="">
                <?php } 
            } 
        ?>
        <div class="flex flex-col justify-center ml-4">
            <div>
                <h1 class="text-5xl font-bold py-8"><?php echo $films_ordered->title; ?> </h1>
                <div class="flex items-center gap-10 pb-10 text-lg font-semibold">
                    <div class="flex items-center gap-2 ml-8">
                        <p> <i class="fa-solid fa-star text-yellow-500"></i> </p> 
                        <p class="text-2xl"> <?php echo substr($films_ordered->vote_average,0,3) ?></p>
                        <div class="h-5 w-0.5 bg-white"></div>
                        <p><?php echo $films_ordered->vote_count; ?> </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <p><?php echo (intval($films_ordered->runtime/60) . "h ". $films_ordered->runtime%60) . "m"; ?> </p>
                        <div class="h-2 w-2 rounded-full bg-white"></div>
                        <p>
                        <?php foreach ($films_ordered->genres as $filmName) { ?>
                        <?php if ($films_ordered->genres == Null) {
                                echo 'No data';
                            } else {
                                echo $filmName->name;
                            }
                        } ?>
                        </p>
                        <div class="h-2 w-2 rounded-full bg-white"></div>
                        <p>
                            <?php if (isset($films_ordered->release_date)){
                                if($films_ordered->release_date == Null){
                                    echo 'No data';
                                }
                                else{
                                    echo substr($films_ordered->release_date,0,4);
                                }}
                            elseif (isset($films_ordered->first_air_date)){
                                if ($films_ordered->first_air_date == Null){
                                    echo 'No data';
                                }
                                else
                                    echo substr($films_ordered->first_air_date,0,4);
                                }
                            else{
                                echo 'release date infound';
                            }
                            ?>
                        </p>
                        <p>
                            <?php if ($films_ordered->adult == Null) {
                            }
                            else{ ?>
                                <div class="h-2 w-2 rounded-full bg-white"></div>
                                <?php echo 'Adult content +18';
                            }?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex gap-12 pb-8 w-[343px] lg:w-[600px]">
                <h2 class="text-xl font-bold">The STORY</h2>
                <p class="font-base"><?php echo $films_ordered->overview; ?> </p>
            </div>
            <div class="flex gap-9 w-[343px] lg:w-[600px]">
                <?php if (($films_ordered->poster_path and $films_ordered->backdrop_path) == null) {
                } else { ?>
                    <h2 class="text-xl font-bold">POSTER</h2>
                    <img class="object-cover w-48 gap-2" src="https://image.tmdb.org/t/p/w500<?php echo $films_ordered->poster_path ?>" alt="" >
                    <img class="object-contain w-48 gap-2" src="https://image.tmdb.org/t/p/w500<?php echo $films_ordered->backdrop_path ?>" alt="" >
                <?php } ?>
            </div>
        </div>
    </div>
</section>
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
                <?php foreach ($result_album as $album_data) {
                    echo $album_data["name"];
                    echo $album_data["description"];
                    echo $album_data["private"];
                }?>
            </div>
        <?php } ?>
    </div>
</body>
