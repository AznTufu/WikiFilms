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
<p class="text-red-500">Bonjour, <?php echo $_SESSION['name'] ?></p>
<form method="POST">
    <label for="28">Action</label>
    <input name="genre[]" type="checkbox" value="28">
    <label>Adventure</label>
    <input name="genre[]" type="checkbox" value="12">
    <label>Animation</label>
    <input name="genre[]" type="checkbox" value="16">
    <label>Comedy</label>
    <input name="genre[]" type="checkbox" value="35">
    <label>Crime</label>
    <input name="genre[]" type="checkbox" value="80">
    <label>Documentary</label>
    <input name="genre[]" type="checkbox" value="99">
    <label>Drama</label>
    <input name="genre[]" type="checkbox" value="18">
    <label>Family</label>
    <input name="genre[]" type="checkbox" value="10751">
    <label>Fantasy</label>
    <input name="genre[]" type="checkbox" value="14">
    <label>History</label>
    <input name="genre[]" type="checkbox" value="36">
    <label>Horror</label>
    <input name="genre[]" type="checkbox" value="27">
    <label>Music</label>
    <input name="genre[]" type="checkbox" value="10402">
    <label>Mystery</label>
    <input name="genre[]" type="checkbox" value="9648">
    <label>Romance</label>
    <input name="genre[]" type="checkbox" value="10749">
    <label>Science Fiction</label>
    <input name="genre[]" type="checkbox" value="878">
    <label>TV Movie</label>
    <input name="genre[]" type="checkbox" value="10770">
    <label>Thriller</label>
    <input name="genre[]" type="checkbox" value="53">
    <label>War</label>
    <input name="genre[]" type="checkbox" value="10752">
    <label>Western</label>
    <input name="genre[]" type="checkbox" value="37">

    <select name="pop" value="pop">
        <option value="desc" >Descending</option>
        <option value="asc" >Ascending</option>
    </select>



    <input type="submit" >
</form>


<?php
require_once 'FilmApi.php';

$api = new FilmApi();

$data = $api->OrderByTrendingDay();
$films_ordered = json_decode($data);


if (isset($_POST['genre']) && isset($_POST['pop'])) {
    var_dump($_POST);
    $ids = $_POST['genre'];
    $pop = $_POST['pop'];

    $api = new FilmApi();

    $data = $api->OrderByPopularityAndGenre($ids, $pop);
    $films_ordered = json_decode($data);

}
?>
<div>
    <?php foreach ($films_ordered->results as $film){ ?>
            <img src=" https://image.tmdb.org/t/p/w500<?php echo $film->backdrop_path ?>" alt="" >
            <h3 ><?php echo $film->title; ?></h3>
            <p><?php $g=$film->genre_ids; $a=sizeof($g); $x=0;
                while($a > $x) {
                    $List_name=$api->NameGenreById($g);
                    $x++;
                }
                foreach ($List_name as $item) {
                    echo $item . ' ';
                }
                ?></p>
            <p>Popularity : <?php echo $film->popularity; ?></p>
            <p>Vote average : <?php echo $film->vote_average ?></p>
            <p>Date de sortie : <?php echo $film->release_date; ?></p>

    <?php } ?>
</div>

</body>

</html>