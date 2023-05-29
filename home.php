<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
<head>
    <title>WikiFilm</title>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Quicksand:wght@500&family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="home.js" defer="true"></script>
</head>


<body>
    <header>
    <nav>
        <div id="logo">
          WikiFilm
        </div>
        <div id="links">
          <a>HOME</a>
          <a href='discover.php'>DISCOVER</a>
          <a>ABOUT</a>
          <a href='profile.php'>PROFILO</a>
          <a href='logout.php' class='button'>LOGOUT</a>
        </div>
    </nav>
        <h1>Trova i film che hai sempre voluto vedere</h1>
        <a class="subtitle">Aggiungili alla tua lista per non dimenticarti dei tuoi titoli preferiti</a>
    </header>
    <section id="search">
      <form autocomplete="off">
        <div class="search">
            <input type='text' name="search" class="searchBar" placeholder="Cerca qui..." required>
            <input type="submit" value="Cerca">
        </div>
      </form>
      
    </section>
    

    <section class="container">

            <div id="results">
                
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