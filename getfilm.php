<?php
require 'vendor/autoload.php';

$client = new \GuzzleHttp\Client(array(
    'verify' => false,
));

$response = $client->request('GET', "https://api.themoviedb.org/3/search/movie/?api_key=d0b7129e9d0d86b5a34fd25e94dc9283&query=" . $_GET["query"]);


header('Content-type:application/json;charset=utf-8');
header('Access-Control-Allow-Origin: *');
echo json_encode(json_decode($response->getBody())->results);


?>