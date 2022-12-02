<?php
namespace FilmApi;

use GuzzleHttp\Client;

class FilmApi
{

    public function __construct()
    {
        $this->baseUrl = "https://api.themoviedb.org/3/";
        $key='?api_key=d0b7129e9d0d86b5a34fd25e94dc9283';
    }
    public function OrderByGenre($ids){

        $ids = join('%2C', $ids);


        $url = $this->baseUrl.'discover/movie'.'?api_key=d0b7129e9d0d86b5a34fd25e94dc9283'.'&with_genres='.$ids;
        var_dump($url);

        return $this->sendRequest($url);
    }

    public function sendRequest($url){
        $client = new Client();
        $response = $client->get($url);

        return $response->getBody();
    }


}
