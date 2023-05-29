<?php
    
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    addtolist();

    function addtolist() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

        $userid = mysqli_real_escape_string($conn, $userid);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $overview = mysqli_real_escape_string($conn, $_POST['overview']);
        $releasedate = mysqli_real_escape_string($conn, $_POST['releasedate']);
        $vote = mysqli_real_escape_string($conn, $_POST['vote']);
        $poster = mysqli_real_escape_string($conn, $_POST['poster']);
    
        $query = "SELECT * FROM films WHERE user = '$userid' AND film_id = '$id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('ok' => true));

            exit;
        }

        $query = "INSERT INTO films(user, film_id, content, watched) VALUES('$userid','$id', JSON_OBJECT('id', '$id', 'title', '$title', 'overview', '$overview', 'releasedate', '$releasedate', 'vote', '$vote', 'poster', '$poster'),0)";
        error_log($query);

        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));

    }