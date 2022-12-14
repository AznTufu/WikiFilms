<?php
namespace FilmApi;

use GuzzleHttp\Client;

class FilmApi
{

    public function __construct()
    {
        $this->baseUrl = "https://api.themoviedb.org/3/";
    }

    public function OrderByTrendingDay(){
        $url = $this->baseUrl.'trending/all/day'.'?api_key=d0b7129e9d0d86b5a34fd25e94dc9283';
        return $this->sendRequest($url);
    }
    public function OrderByName(){

    }

    public function Search($letters){
        $url = 'https://api.themoviedb.org/3/search/movie?api_key=d0b7129e9d0d86b5a34fd25e94dc9283&query=$letters';
        return $this->sendRequest($url);
    }

    public function Movie_id($id_film){
        $url = "https://api.themoviedb.org/3/movie/" . $id_film . "?api_key=d0b7129e9d0d86b5a34fd25e94dc9283";
        return $this->sendRequest($url);
    }

    public function Order($ids,$pop, $adult, $imdb){

        $url = $this->baseUrl.'discover/movie'.'?api_key=d0b7129e9d0d86b5a34fd25e94dc9283';

        /* add or not genre filter */
        if ($ids == false){
            $url = $url;
        }
        else{
            $ids = join('%2C', $ids);
            $url = $url . '&with_genres=' . $ids;
        }

        /* add or not pop filter */
        if ($pop == "asc"){
            $url = $url.'&sort_by=popularity.asc';
        }
        elseif ($pop == "desc"){
            $url = $url.'&sort_by=popularity.desc';
        }
        else {
            var_dump('Le parametre doit posseder comme valeur asc ou desc');
        }

        /* add or not adult filter */
        if ($adult){
            $url = $url . "&include_adult=true";
        }
        else{
            $url = $url ."&include_adult=false";
        }

        /* add or not imdb filter */
        if ($imdb == false){
            $url = $url ;
        }
        else{
            $url = $url . "&vote_average.gte=" . $imdb;
        }

        return $this->sendRequest($url);
    }


    public function NameGenreById($id){

        $List_name=[];

        foreach ($id as $i) {

            switch ($i){
                case 28:
                    array_push($List_name, 'Action');
                    break;
                case 12:
                    array_push($List_name, 'Adventure');
                    break;
                case 16:
                    array_push($List_name, 'Animation');
                    break;
                case 35:
                    array_push($List_name, 'Comedy');
                    break;
                case 80:
                    array_push($List_name, 'Crime');
                    break;
                case 99:
                    array_push($List_name, 'Documentary');
                    break;
                case 18:
                    array_push($List_name, 'Drama');
                    break;
                case 10751:
                    array_push($List_name, 'Family');
                    break;
                case 14:
                    array_push($List_name, 'Fantasy');
                    break;
                case 36:
                    array_push($List_name, 'History');
                    break;
                case 27:
                    array_push($List_name, 'Horror');
                    break;
                case 10402:
                    array_push($List_name, 'Music');
                    break;
                case 9648:
                    array_push($List_name, 'Mystery');
                    break;
                case 10749:
                    array_push($List_name, 'Romance');
                    break;
                case 878:
                    array_push($List_name, 'Science Fiction');
                    break;
                case 10770:
                    array_push($List_name, 'TV Movie');
                    break;
                case 53:
                    array_push($List_name, 'Thriller');
                    break;
                case 10752:
                    array_push($List_name, 'War');
                    break;
                case 37:
                    array_push($List_name, 'Western');
                    break;
            }
        }
        return $List_name;
    }






    public function sendRequest($url){
        $client = new Client();

        $response = $client->get($url);


        return $response->getBody();
    }


}
