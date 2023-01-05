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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
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

    <label for="">Select the popularity order :</label>
    <select name="pop" value="pop">
        <option value="desc" >Descending</option>
        <option value="asc" >Ascending</option>
    </select>

    <label for="">Do you want film including -18 limitation ?</label>
    <input type="checkbox" name="adult" value="true">

    <label for="">Select the minimum score you want on Avis IMDB rating (0-10) </label>
    <input type="number" name="imdb">


    <input type="submit" >
</form>


<?php
require_once 'FilmApi.php';

$api = new FilmApi();

$data = $api->OrderByTrendingDay();
$films_ordered = json_decode($data);



if ($_POST) {
    var_dump($_POST);
    if (isset($_POST['genre'])){
        $ids = $_POST['genre'];
    }
    else{
        $ids = false;
    }

    $pop = $_POST['pop'];


    if (isset($_POST['adult'])){
        $adult = true;
    }
    else{
        $adult = false;
    }

    if (isset($_POST['imdb'])){
        $imdb = $_POST['imdb'];
    }
    else{
        $imdb = false;
    }

    $api = new FilmApi();

    $data = $api->Order($ids, $pop, $adult, $imdb);
    $films_ordered = json_decode($data);
}
?>
<section class="grid grid-cols-4 gap-6 mx-[150px] my-[50px]">
    <?php foreach ($films_ordered->results as $film){ ?>
        <div class="flex flex-col bg-white shadow-lg border-current">
            <a href="SinglePage.php">
                <?php if($film->backdrop_path == Null){ ?>
                    <img src="img/question_mark.jpg" alt="" >
                <?php }
                else{ ?>
                    <img src=" https://image.tmdb.org/t/p/w500<?php echo $film->backdrop_path ?>" alt="" >
                <?php }?>
                <div class="px-4 py-2">
                    <h3 class="text-xl text-[#212c36] font-bold">
                        <?php if (isset($film->title)){
                            echo $film->title;
                        }
                        elseif (isset($film->name)){
                            echo $film->name;
                        }
                        else{
                            echo 'title infound';
                        }?>
                    </h3>
                    <p class="pt-1 text-l text-[#a1b2bc] font-semibold"><?php
                        if($film->genre_ids == Null){
                            echo 'No data';
                        }
                        else{
                            $g=$film->genre_ids; $a=sizeof($g); $x=0;
                            while($a > $x) {
                                $List_name=$api->NameGenreById($g);
                                $x++;
                            }
                            foreach ($List_name as $item) {
                                echo $item . ' ';
                            }
                        }
                        ?>
                    </p>
                    <div class="flex gap-4 pt-1">
                        <p> <i class="fa-solid fa-eye opacity-50"></i> <?php echo $film->popularity ?></p>
                        <p> <i class="fa-solid fa-check-to-slot opacity-50"></i> <?php echo $film->vote_average ?></p>
                    </div>
                    <div class="flex gap-4 pt-1">
                        <p class="text-[#334454] font-semibold">
                            <?php if (isset($film->release_date)){
                                if($film->release_date == Null){
                                    echo 'No data';
                                }
                                else{
                                    echo $film->release_date;
                                }}
                            elseif (isset($film->first_air_date)){
                                if ($film->first_air_date == Null){
                                    echo 'No data';
                                }
                                else
                                    echo $film->first_air_date;
                                }
                            else{
                                echo 'release date infound';
                            }
                            ?>
                        </p>
                        <p>
                            <?php if ($film->adult == Null) {
                            }
                            else{
                                echo 'Adult content +18';
                            }?>
                        </p>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
</section>

</body>

</html>