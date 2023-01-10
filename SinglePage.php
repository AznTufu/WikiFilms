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

<section class="sticky bg-white shadow-lg border-current mb-8">
    <div class="flex items-center justify-between pl-8 pr-8 xl:pl-36 py-2 px-1 max-w-[1800px]">
        <a href="index.php" class="w-[50px] lg:w-[100px] ml-8 xl:ml-24 2xl:ml-34"><img src="img/logo.png" alt="logo"></a>
        <div>
            <a href="profil.php" class="text-lg lg:text-2xl font-semibold text-[#333] mr-6 lg:mr-10"><?php echo $_SESSION['name'] ?></a>
            <a href="login.php"><i class="fa-solid fa-right-from-bracket sm:mr-6 lg:mr-8 xl:mr-10 text-xl"></i></a>
        </div>
    </div>
</section>

<section class="flex justify-center rounded-3xl">
    <div class="flex flex-col lg:flex-row bg-[#17181C] text-white shadow-lg border-current rounded-lg w-[450px] mb-6 lg:w-[1285px] lg:mb-12 ">
        <?php 
            if(($films_ordered->poster_path and $films_ordered->belongs_to_collection) === Null) { ?>
                <img src="img/question_mark.jpg" alt="Missing image">
            <?php } else {
                if ($films_ordered->belongs_to_collection == null) { ?>
                    <img class="rounded-l-lg" src="https://image.tmdb.org/t/p/w500<?php echo $films_ordered->poster_path ?>" alt="poster image" >
                <?php } else { 
                    if ($films_ordered->belongs_to_collection->poster_path == null) { ?>
                        <img class="rounded-l-lg" src="https://image.tmdb.org/t/p/w500<?php echo $films_ordered->poster_path ?>" alt="poster image" >
                    <?php } else { ?>
                        <img class="rounded-l-lg" src="https://image.tmdb.org/t/p/w500<?php echo $films_ordered->belongs_to_collection->poster_path; ?>" alt="poster image">
                <?php } 
                } 
            } 
        ?>
        <div class="flex flex-col justify-center ml-4">
            <div>
                <h1 class="text-4xl lg:text-5xl font-bold py-8"><?php echo $films_ordered->title; ?> </h1>
                <div class="flex items-start lg!items-center gap-10 pb-10 text-lg font-semibold">
                    <div class="flex items-center gap-2 ml-8">
                        <p> <i class="fa-solid fa-star text-yellow-500"></i> </p> 
                        <p class="text-wl lg:text-2xl"> <?php echo substr($films_ordered->vote_average,0,3) ?></p>
                        <div class="h-5 w-0.5 bg-white"></div>
                        <p><?php echo $films_ordered->vote_count; ?> </p>
                    </div>
                    <div class="flex flex-col lg:flex-row max-lg:justify-center items-start lg:items-center gap-3">
                        <p><?php echo (intval($films_ordered->runtime/60) . "h ". $films_ordered->runtime%60) . "m"; ?> </p>
                        <div class="h-2 w-2 rounded-full bg-white hidden lg:block"></div>
                        <p>
                        <?php foreach ($films_ordered->genres as $filmName) { ?>
                        <?php if ($films_ordered->genres == Null) {
                                echo 'No data';
                            } else {
                                echo $filmName->name;
                            }
                        } ?>
                        </p>
                        <div class="h-2 w-2 rounded-full bg-white hidden lg:block"></div>
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
                                <div class="h-2 w-2 rounded-full bg-white hidden lg:block"></div>
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
            <div class="flex flex-col lg:flex-row gap-9 w-[343px] lg:w-[600px] lg:items-start">
                <?php if (($films_ordered->poster_path and $films_ordered->backdrop_path) == null) {
                } else { ?>
                    <h2 class="text-xl font-bold">POSTER</h2>
                    <img class="object-cover w-48 gap-2" src="https://image.tmdb.org/t/p/w500<?php echo $films_ordered->poster_path ?>" alt="poster image" >
                    <div class="flex flex-col my-3">
                        <img class="object-contain w-48 gap-2 mb-4" src="https://image.tmdb.org/t/p/w500<?php echo $films_ordered->backdrop_path ?>" alt="poster image" >
                        <?php if ($films_ordered->belongs_to_collection == null) {
                        } else {
                            if ($films_ordered->belongs_to_collection->backdrop_path == null) {
                            } else { ?>
                            <img class="object-contain w-48 gap-2" src="https://image.tmdb.org/t/p/w500<?php echo $films_ordered->belongs_to_collection->backdrop_path ?>" alt="poster image" >
                        <?php }
                        }   ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
                            
<div>
    <div class="flex justify-center items-center my-4 lg:my-5">
        <div class="shadow-lg flex flex-col justify-end items-center mx-4 my-4 lg:my-12 w-[450px] h-[450px] bg-white rounded-[30px] xl:w-[550px] xl:h-[480px]">
            <h1 class="flex justify-center items-center text-2xl lg:text-4xl font-bold p-6 mb-12">Ajout / suppression d'un film</h1>
            <form method="POST">
                <input class="flex justify-center px-6 py-0 gap-2.5 mb-4 w-[275px] h-[56px] border-[#333] border-2 rounded-[30px] xl:w-[400px] xl:mr-4" type="text" name="name" placeholder="Nom d'un de vos albums" required>
                <select class="flex justify-center px-6 py-0 gap-2.5 w-[275px] h-[56px] border-[#333] border-2 rounded-[20px] xl:w-[400px] xl:mr-4" name="deloradd" >
                    <option value="add">Ajouter</option>
                    <option value="delete">Suprimer</option>
                </select>
                <input class="flex justify-center px-6 py-0 gap-2.5 my-12 w-[275px] h-[56px] bg-[#F3EDFB] rounded-[30px] xl:w-[400px] xl:mr-4 shadow-md" type="submit" value="Modification de l'album">
            </form> 
        </div>
    </div>
</div>

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
                if ($result_movie) { ?>
                    <h3 class="flex justify-center text-xl lg:text-2xl font-bold py-2 lg:py-0">We add this film to your album.</h3>
                <?php } else {
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
                if ($result_movie_del) { ?>
                    <h3 class="flex justify-center text-xl lg:text-2xl font-bold py-2 lg:py-0">We delete this film to your album.</h3>
                <?php } else {
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
                <?php
                $connection = new Connection();
                $result_movie = $connection->show_film($user_id, $album_data['id']);
                if ($result_movie==null){
                    echo 'Aucun film dans cet album';
                }
                else{
                    require_once 'FilmApi.php';

                    foreach ($result_movie as $curent_result_movie){
                        $connection = new FilmApi();
                        $result_movie_data = $connection->Movie_id($curent_result_movie["movie_id"]);
                        $a = json_decode($result_movie_data);
                        if (isset($a->title)){
                            echo $a->title;
                        }
                        elseif (isset($a->name)){
                            echo $a->name;
                        }
                        else{
                            echo 'title infound';
                        }




                    }


                }


                ?>
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