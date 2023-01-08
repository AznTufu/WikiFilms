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
<body>
<input type="text" class="recherche">
<p class="text-red-500">Bonjour, <?php echo $_SESSION['name'] ?></p>

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

<div class="flex gap-8 mx-[140px] my-[50px]">
    <section class="grid grid-cols-4 gap-8">
        <?php foreach ($films_ordered->results as $film){ ?>
            <div class="flex flex-col bg-white shadow-lg border-current">
                <?php $id_film=$film->id; ?>
                <a href="SinglePage.php?film_id=<?php echo $id_film ?>">
                    <?php if($film->backdrop_path == Null){ ?>
                        <img src="img/question_mark.jpg" alt="" >
                    <?php }
                    else{ ?>        
                        <img src="https://image.tmdb.org/t/p/w500<?php echo $film->poster_path ?>" alt="" >
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
                        <div class="flex gap-2 pt-1 text-l">
                            <p class="text-[#334454] font-semibold">
                                    <?php if (isset($film->release_date)){
                                        if($film->release_date == Null){
                                            echo 'No data';
                                        }
                                        else{
                                            echo substr($film->release_date,0,4);
                                        }}
                                    elseif (isset($film->first_air_date)){
                                        if ($film->first_air_date == Null){
                                            echo 'No data';
                                        }
                                        else
                                            echo substr($film->first_air_date,0,4);
                                        }
                                    else{
                                        echo 'release date infound';
                                    }
                                    ?>
                                </p>
                                <p class="text-[#a1b2bc] font-semibold"><?php
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
                        </div>
                        <div class="flex gap-4 pt-1 items-center">
                            <p> <i class="fa-solid fa-star opacity-50"></i> <?php echo substr($film->vote_average,0,3) ?></p>
                            <p> <i class="fa-solid fa-eye opacity-50"></i> <?php echo $film->popularity ?></p>
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
    <section>
        <form method="POST">
            <div class="bg-white-500 shadow-lg border-2 h-[500px] w-[350px] p-6">
                <div class="grid grid-cols-2 gap-1">
                    <div>
                        <label for="28">Action</label>
                        <input name="genre[]" type="checkbox" value="28">
                    </div>
                    <div>
                        <label>Adventure</label>
                        <input name="genre[]" type="checkbox" value="12">
                    </div>
                    <div>
                        <label>Animation</label>
                        <input name="genre[]" type="checkbox" value="16">
                    </div>
                    <div>
                        <label>Comedy</label>
                        <input name="genre[]" type="checkbox" value="35">
                    </div>
                    <div>
                        <label>Crime</label>
                        <input name="genre[]" type="checkbox" value="80">
                    </div>
                    <div>
                        <label>Documentary</label>
                        <input name="genre[]" type="checkbox" value="99">
                    </div>
                    <div>
                        <label>Drama</label>
                        <input name="genre[]" type="checkbox" value="18">
                    </div>
                    <div>
                        <label>Family</label>
                        <input name="genre[]" type="checkbox" value="10751">
                    </div>
                    <div>
                        <label>Fantasy</label>
                        <input name="genre[]" type="checkbox" value="14">
                    </div>
                    <div>
                        <label>History</label>
                        <input name="genre[]" type="checkbox" value="36">
                    </div>
                    <div>
                        <label>Horror</label>
                        <input name="genre[]" type="checkbox" value="27">
                    </div>
                    <div>
                        <label>Music</label>
                        <input name="genre[]" type="checkbox" value="10402">
                    </div>
                    <div>
                        <label>Mystery</label>
                        <input name="genre[]" type="checkbox" value="9648">
                    </div>
                    <div>
                        <label>Romance</label>
                        <input name="genre[]" type="checkbox" value="10749">
                    </div>
                    <div>
                        <label>Science Fiction</label>
                        <input name="genre[]" type="checkbox" value="878">
                    </div>
                    <div>
                        <label>TV Movie</label>
                        <input name="genre[]" type="checkbox" value="10770">
                    </div>
                    <div>
                        <label>Thriller</label>
                        <input name="genre[]" type="checkbox" value="53">
                    </div>
                    <div>
                        <label>War</label>
                        <input name="genre[]" type="checkbox" value="10752">
                    </div>
                    <div>
                        <label>Western</label>
                        <input name="genre[]" type="checkbox" value="37">
                    </div>
                </div>
                <div>
                    <div class="pt-1">
                        <label for="">Popularity:</label>
                        <select name="pop" value="pop" >
                            <option value="desc" >Descending</option>
                            <option value="asc" >Ascending</option>
                        </select>
                    </div>
                    <div class="pt-1">
                        <label for="">Rating limitation (0-10) </label>
                        <input type="number" name="imdb" class="border-solid border-2">
                    </div>
                    <div class="pt-1 pb-4">
                        <label for="">Adult content </label>
                        <input type="checkbox" name="adult" value="true">
                    </div>
                    <div class="border-solid border-2 p-2.5 w-[5em]">
                        <input type="submit">
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="js.js"></script>

</html>