<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php 
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>

    <head>
        <link rel='stylesheet' href='profile.css'>
        <script src='profile.js' defer></script>
        <meta charset="utf-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Quicksand:wght@500&family=Rubik:wght@300&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        

        <title>WikiFilm - <?php echo $userinfo['name']." ".$userinfo['surname'] ?></title>
    </head>

    <body>
        <header>
            <nav>
                <div class="nav-container">
                    <div id="logo">
                         WikiFilm
                    </div>
                    <div id="links">
                        <a href='home.php'>HOME</a>
                        <a href='discover.php'>DISCOVER</a>
                        <a>ABOUT</a>
                        <a>CONTACT</a>
                        <a href='logout.php' class='button'>LOGOUT</a>
                    </div>
                   
                </div>
                <div class="userInfo">
                    <h1>Profilo: <?php echo $userinfo['name']." ".$userinfo['surname'] ?></h1>
                </div>               
            </nav>
        </header>

        <section class="containerlist">
            <h3>Lista dei film salvati</h3>

            <div id="resultslist">
                
            </div>
        </section>

        <section class="containerwatched">
            <h3>Film guardati</h3>
            <div id="resultswatched">
                
            </div>
        </section>

        <div class="footer-basic">
        <footer>
            <div class="footer-row">
                <a href="#">Home</a>
                <a href="#">Services</a>
                <a href="#">About</a>
                <a href="#">Terms</a>
                <a href="#">Privacy Policy</a>
            </div>
            <p class="copyright">Federica Crocetta 1000015905 © 2023</p>
        </footer>
        </div>

    </body>
</html>

<?php mysqli_close($conn); ?>
