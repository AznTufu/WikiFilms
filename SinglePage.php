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
<section>
    <?php 
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
        <?php if ($films_ordered->belongs_to_collection == null) {
    } else { ?>
        <img src=" https://image.tmdb.org/t/p/w500<?php echo $films_ordered->belongs_to_collection->poster_path; ?>" alt="">
    <?php } ?>

    <h1 class="text-xl text-[#212c36] font-bold"><?php echo $films_ordered->title; ?> </h1>
    <?php echo (intval($films_ordered->runtime/60) . "h ". $films_ordered->runtime%60) . "m"; ?> 
    <?php echo $films_ordered->vote_average; ?> 
    <?php echo $films_ordered->vote_count; ?> 
    <?php echo $films_ordered->overview; ?> 

    <p>
        <?php if ($films_ordered->adult == Null) {
        }
        else{
            echo 'Adult content +18';
        }?>
    </p>
    <?php echo $films_ordered->tagline; ?> 
    </div>
</section>
</body>
