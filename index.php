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
    <title>Document</title>
</head>
<body>
<p>Bonjour, <?php echo $_SESSION['name'] ?></p>
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

    <input type="submit" value="submit" placeholder="Recherche">
</form>



<?php

require_once 'FilmApi.php';

if($_POST){



    $ids = $_POST['genre'];

    $numGenre = [];
    $api = new FilmApi();

    $data = $api->OrderByGenre($ids);
    $films_ordered = json_decode($data);


}



?>
<script>
export default {
    name: "get-request",
    data() {
        return {
            films: null
        };
    },
    created() {
        // Simple GET request using fetch
        fetch("https://api.themoviedb.org/3/discover/movie?api_key=d0b7129e9d0d86b5a34fd25e94dc9283")
            .then(response => response.json())
            .then(data => (this.films = data));

    }
};

</script>


</body>
</html>