<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
<head>
    <title>WikiFilm - Discover</title>

    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Quicksand:wght@500&family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="discover.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="discover.js" defer="true"></script>
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
          <a>DISCOVER</a>
          <a>ABOUT</a>
          <a href='profile.php'>PROFILO</a>
          <a href='logout.php' class='button'>LOGOUT</a>
        </div>
        </div>
    </nav>
    <h1>Scopri film nuovi</h1>
    </header>

    <section class="containertheatres">
            <h3>In questo momento nelle sale:</h3>

            <div id="resultstheatres">
                
            </div>
        </section>

        <section class="containertoprated">
            <h3>I più apprezzati dal pubblico:</h3>

            <div id="resultstoprated">
                
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

