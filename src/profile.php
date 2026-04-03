<?php
    session_start();
    $nev="localhost";
    $unev="roli2004";
    $password="Deirfyof";
    $db_name="roli2004";
    
    $conn=new mysqli($nev, $unev, $password, $db_name);
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>CheckAnime</title>
        <link href="https://fonts.googleapis.com/css2?family=Shantell+Sans&display=swap" 
        rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="stylesprofile.css">
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
            $user_id=$_SESSION['ID'];
            $sql="SELECT * FROM ATESTAT WHERE id=$user_id";
            $result=mysqli_query($conn, $sql);
            $user=mysqli_fetch_assoc($result);

            $sql2="SELECT * FROM Comments WHERE user_id=$user_id";
            $result2=mysqli_query($conn, $sql2);
            $reviews = array();
            while ($row = mysqli_fetch_assoc($result2)) {
                $reviews[] = $row;
            }
            $fav_anime_id = $user['Favourite'];
            $sql3 = "SELECT * FROM Animes WHERE id=$fav_anime_id";
            $result3 = mysqli_query($conn, $sql3);
            $fav_anime = mysqli_fetch_assoc($result3);
            ?>
            <div class="account-details">
                <h1><?php echo $user['Username']; ?>'s Account</h1>
            </div>

            <div class="account-favorite">
                <h2>Favorite Anime</h2>
                <?php if ($fav_anime): ?>
                    <div class="favorite-anime">
                        <img src="<?php echo $fav_anime['Picture']; ?>" alt="<?php echo $fav_anime['Title']; ?>">
                        <h3><?php echo $fav_anime['Title']; ?></h3>
                    </div>
                <?php else: ?>
                    <p>No favorite anime selected.</p>
                <?php endif; ?>
            </div>
            
            <div class="account-reviews">
                <h2>Reviews</h2>
                <?php foreach ($reviews as $review): ?>
                    <?php
                    $anime_id=$review['anime_id'];
                    $sqla="SELECT Picture, Title FROM Animes WHERE id=$anime_id";
                    $resulta=mysqli_query($conn, $sqla);
                    $anime=mysqli_fetch_assoc($resulta);
                    ?>
                    <div class="review">
                        <img src="<?php echo $anime["Picture"]; ?>" alt="<?php echo $anime["Title"]; ?>">
                        <div class="review-details">
                            <h3><?php echo $anime["Title"],'  ', $review['Date']; ?></h3>
                            <p><?php echo $review['Comments']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
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
    </body>
</html>


