<?php 
   
   require_once 'dbconfig.php';

   //controlla che il param q abbia un valore, se non lo ha non dovremmo essere in questa parte dello script
    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    //definisce il tipo di risposta che viene inviata al client, in questo caso json
    header('Content-Type: application/json');
    
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $username = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT username FROM users
                WHERE username = '$username'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    //manda la risposta in json facendo l'encode dell'array
    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_close($conn);
?>