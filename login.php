<?php

    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        // ID e Username per sessione, password per controllo
        $query = "SELECT * FROM users WHERE username = '".$username."'";
        
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
        
        if (mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['password'])) {

                // imposto la sessione dell'utente
                $_SESSION["_username"] = $entry['username'];
                $_SESSION["_user_id"] = $entry['id'];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }

        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        $error = "Inserisci username e password.";
    }

?>


<html>
    <head>
        <link rel='stylesheet' href='login.css'>

        <meta charset="utf-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Quicksand:wght@500&family=Rubik:wght@300&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>Log in - WikiFilm</title>  
    </head>

    <body>
        <div id="logo">
            WikiFilm
        <div>
        <main>
            <section>
            <h3>Accedi a WikiFilm.</h3>
                <?php
                    // Verifica la presenza di errori
                    if (isset($error)) {
                        echo "<p class='error'>$error</p>";
                    }
                
                ?>
                <form name='login' method='post'>
                
                    <div class="username">
                        <label for='username'>Username</label>
                        <input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                    </div>
                    <div class="password">
                        <label for='password'>Password</label>
                        <input type='password' name='password'>
                    </div>
                    <div class="submit-container">
                        <div class="login-btn">
                        <input type='submit' value="Log In">
                        </div>
                    </div>
                    <div class="signup"><h1>Non hai un account?</h1></div>
                <div class="signup-btn-container"><a class="signup-btn" href="signup.php">Iscriviti a WikiFilm</a></div>
            
                </form>
                </section>
        </main>
        
    </body>

</html>