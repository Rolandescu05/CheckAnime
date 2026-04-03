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
        <link rel="stylesheet" type="text/css" href="stylesanime.css">
        <link href="https://fonts.googleapis.com/css2?family=Shantell+Sans&display=swap" 
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
        crossorigin="anonymous" referrerpolicy="no-referrer">
        <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    </head>
    <body>
<?php
    $servername = "localhost";
    $username = "roli2004";
    $password = "Deirfyof";
    $dbname = "roli2004";

    $conn= new mysqli($servername, $username, $password, $dbname);
    $id=$_GET['id'];
    $sql="SELECT * from Animes where id=$id";
    $result=mysqli_query($conn, $sql);
    $anime=mysqli_fetch_assoc($result);
?>
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
    <div class="anime-info">
  <h1><?php echo $anime['Title']; ?></h1>
  <div class="anime-image">
    <img src="<?php echo $anime['Picture']; ?>" alt="<?php echo $anime['Title']; ?>">
  </div>
  <div class="anime-details">
    <div class="anime-rating">
      <h2><?php echo '<span class="rating">&#9733;</span>'. $anime['Rating']; ?></h2>
    </div>
    <?php
        $user_id = $_SESSION["ID"];
        $anime_id = $_GET['id'];
        $sql5 = "SELECT * FROM ATESTAT WHERE id='$user_id' AND Favourite='$anime_id'";
        $result5 = mysqli_query($conn, $sql5);
        $fav = mysqli_num_rows($result5) > 0;

        if (isset($_POST["mark"])) {
            $sql6 = "UPDATE ATESTAT SET Favourite = '$anime_id' WHERE ID = '$user_id'";
            $result6 = mysqli_query($conn, $sql6);
            if ($result6) {
                $fav = true;
            }
        } elseif (isset($_POST["unmark"])) {
            $sql7 = "UPDATE ATESTAT SET Favourite = NULL WHERE ID = '$user_id'";
            $result7 = mysqli_query($conn, $sql7);
            if ($result7) {
                $fav = false; 
            }
        }
    ?>

<form method="POST" action="">
    <input type="hidden" name="anime_id" value="<?php echo $anime_id; ?>">
    <?php if ($fav): ?>
        <button class="favorite-btn" type="submit" name="unmark">Unmark as favourite</button>
    <?php else: ?>
        <button class="favorite-btn" type="submit" name="mark">Mark as favourite</button>
    <?php endif; ?>
</form>


    <div class="anime-description">
      <p><?php echo $anime['Description']; ?></p>
    </div>
    <div class="anime-stats">
      <ul>
        <li>Number of episodes: <?php echo $anime['Episodes']; ?></li>
        <li>Studio: <?php echo $anime['Production']; ?></li>
        <li>Aired from: <?php echo $anime['Air']; ?></li>
      </ul>
    </div><br><br>

<h3>Leave a review:</h3><br>
<form action="" method="POST">
  <input type="hidden" name="anime_id" value="<?php echo $anime_id; ?>">
  <input type="hidden" name="user_id" value="<?php echo $_SESSION['ID']; ?>">
  <textarea name="review" id="review" rows=5></textarea><br>
  <input type="submit" name="submit" value="Publish"><br><br>
</form>
<?php
if (isset($_POST["submit"])){
    $comments = $_POST["review"];
    $date = date('Y-m-d H:i:s');
    $anime_id = $_GET['id'];
    $user_id = $_SESSION['ID'];

    $sql3 = "INSERT INTO Comments (user_id, anime_id, Comments, Date) VALUES ('$user_id', '$anime_id', '$comments', '$date')";
    $result3 = mysqli_query($conn, $sql3);

    if ($result3) {
        echo "Review submitted successfully!";
    } else {
        echo "Error submitting review.";
    }
}

?>
<?php
    $anime_id = $_GET['id'];
    print("<h2>Reviews by other users</h2>");
    $sql4="Select ATESTAT.Username, Comments.Date, Comments.Comments FROM Comments JOIN ATESTAT ON 
    Comments.user_id=ATESTAT.ID where Comments.anime_id='$anime_id' ORDER BY Comments.Date DESC";
    $result4=mysqli_query($conn, $sql4);
?>
<?php  if (mysqli_num_rows($result4)> 0) { ?>
    <div class="review-container"><?php while ($row4=mysqli_fetch_assoc($result4)){ ?>
        <div class="review">
            <div class="user"><?php echo $row4["Username"]; ?></div>
            <div class="date"><?php echo $row4["Date"]; ?></div>
            <div class="comment"><?php echo $row4["Comments"]; ?></div>
        </div>
    <?php } ?>
    </div>
<?php 
    } else {
        echo "<h4>No reviews yet.</h4>";
    }
    mysqli_close($conn);
?>
</div>
</div>
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
