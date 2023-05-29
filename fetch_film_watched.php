<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $userid = mysqli_real_escape_string($conn, $userid);

    $query = "SELECT user AS userid, id AS filmid, content AS content from films where user = $userid and watched = 1 ORDER BY id DESC LIMIT 10";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $filmArray = array();
    while($entry = mysqli_fetch_assoc($res)) {
        $filmArray[] = array('userid' => $entry['userid'],
                            'filmid' => $entry['filmid'], 'content' => json_decode($entry['content']));
    }
    echo json_encode($filmArray);
    
    exit;


?>