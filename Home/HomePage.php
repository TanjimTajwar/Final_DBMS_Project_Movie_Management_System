<?php
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobra Movies</title>
    <link rel="stylesheet" href="../css/HomePage.css">
</head>
<body>
    <header class="navbar">
        <div class="logo"><a href="../home/HomePage.php">Jobra Movies</a></div>
        <nav>
           <ul>
                <li><a href="../Home/HomePage.php">HOME</a></li>
                <li><a href="../Home/Showtimes.php">SHOWTIMES</a></li>
                <li><a href="../Home/buy.php">Ticket Price</a></li>
                <li><a href="../Home/Review.php">Review</a></li>
                <li><a href="../Home/CommingSoon.php">Coming Soon</a></li>
                <li><a href="../Home/AboutUss.php">About Us</a></li>
                <li>
                    <a href="../user_dashboard/user_dashboard.php">
                        <?php 
                            if (isset($_SESSION['username'])) {
                                echo htmlspecialchars($_SESSION['username']); 
                            } else {
                                echo "User";
                            }
                        ?>
                    </a>
                </li>
        </ul>
        </nav>
    </header>
    <div id="addPushpaImg">
        <img src="../images/Pushpa.png" alt="Pushpa Movie Poster" width="1375px">
    </div>
<section class="hero">
    <div class="hero-content">
        <h1>Trending: Pushpa</h1>
        <div class="actions">
            <button>
                <a href="../home/showtimes.php">SHOWTIME</a>
            </button>
            <button>
                <a href="../home/buy.php">Buy Ticket</a>
            </button>
        </div>
    </div>
</section>


    <section class="movie-gallery">
        <h2>More to See</h2>
        <div class="movies">
            <div class="movie">
                <img src="../Images/Vaikunthapurramuloo.png" alt="Vaikunthapurramuloo">
                <p>Vaikunthapurramuloo</p>
            </div>
            <div class="movie">
                <img src="../Images/Loki.png" alt="Loki">
                <p>Loki</p>
            </div>
            <div class="movie">
                <img src="../Images/Jailer.png" alt="Jailer">
                <p>Jailer</p>
            </div>
            <div class="movie">
                <img src="../Images/Good-Newwz.png" alt="Good Newwz">
                <p>Good Newwz</p>
            </div>
        </div>
    </section>
</body>
</html>
