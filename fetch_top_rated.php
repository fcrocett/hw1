<?php 
require_once 'auth.php';

if (!checkAuth()) exit;

header('Content-Type: application/json');

tmdb();

function tmdb() {
    $key = 'f628e94108b998d39f31c9a3c2fe7c62';
    $url = 'https://api.themoviedb.org/3/movie/top_rated?api_key='.$key;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
};
?>