<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    }
?>
<!DOCTYPE  html>
<html>
    <head>
        <title>
            CheckAnime
        </title>
        <link href="https://fonts.googleapis.com/css2?family=Shantell+Sans&display=swap" 
        rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="stylestop.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
        crossorigin="anonymous" referrerpolicy="no-referrer">
        <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="header">
            <a href="main.php"><img src="uzumaki.webp" class="imgl"></a>
            <a href="main.php" class="logo logo-text">CheckAnime</a>
            <nav class="navbar">
                <a href="home.html"><i class="fas fa-home"></i> Home</a>
                <a href="top.php"><i class="fas fa-star"></i> Top Anime</a>
                <a href="about.php"><i class="fas fa-info-circle"></i> About</a>
                <a href="contact.php"><i class="fas fa-envelope"></i> Contact us</a>
                <?php if(isset($_SESSION['uname'])) : ?>
                    <a href="profile.php"><i class="fas fa-user"></i> <?php echo $_SESSION['uname']; ?> </a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout </a>
                <?php else : ?>
                    <a href="signup.php"><i class="fas fa-user-plus"></i> Sign up</a>
                <?php endif; ?>
            </nav>
        </div>
        <?php
            $servername = "localhost";
            $username = "roli2004";
            $password = "Deirfyof";
            $dbname = "roli2004";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM Animes order by Rating DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="anime-list">';
                while($row = $result->fetch_assoc()) {
                    echo '<div class="anime">';
                    echo '<a href="anime.php?id=' . $row["ID"] . '">';
                    echo '<img src="' . $row["Picture"] . '" alt="' . $row["Title"] . '">';
                    echo '<h2>' . $row["Title"] . '</h2>';
                    echo '<p><span class="rating">&#9733;</span> ' . $row["Rating"] . '</p>';
                    echo '</a>';
                    echo '</div>';
                }
                echo '</div>';
            }

            $conn->close();
        ?>
      <footer>
      <div class="footerContainer">
                <div class="socialIcons">
                    <a href="https://www.facebook.com/roland.iacob.10"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://www.instagram.com/roli01010101/"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://twitter.com/Rolie1005"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.youtube.com/channel/UCWwENl7N7TfxPWhMStMuoeg"><i class="fa-brands fa-youtube"></i></a>
                </div>
                <div class="footerNav">
                    <ul>
                       <li><a href="home.html">Home</a></li>
                       <li><a href="about.php">About</a></li>
                       <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="footerBottom">
                <p> Copyright &copy;2023; Designed by <span class="designer">Iacob Roland</span></p>
            </div>  
      </footer>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>
</html>