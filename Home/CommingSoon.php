<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobra Movies - Coming Soon</title>
    <link rel="stylesheet" href="../CSS/CommingSoon.css">
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

    <section class="movie-list">
        <!-- Movie 1 -->
        <div class="movie-card">
            <img src="../Images/Avatar3.png" alt="Avatar 3">
            <div class="movie-info">
                <h2>Avatar 3</h2>
                <p><strong>Rating:</strong> Not Yet Rated</p>
                <p><strong>Duration:</strong> 180 Min</p>
                <p><strong>Category:</strong> 3D, IMAX</p>
                <p><strong>Actor:</strong> Sam Worthington, Zoe Saldana, Sigourney Weaver</p>
                <p><strong>Genre:</strong> Sci-Fi, Adventure</p>
                <p><strong>Release:</strong> December 20, 2024</p>
                <p><strong>Language:</strong> English</p>
                <div class="actions">
                        <a href="https://www.youtube.com/watch?v=YXtWPVFk5TQ">
                        <button>Watch Trailer</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Movie 2 -->
        <div class="movie-card">
            <img src="../Images/Dune Part 2.png" alt="Dune Part 2">
            <div class="movie-info">
                <h2>Dune: Part 2</h2>
                <p><strong>Rating:</strong> Not Yet Rated</p>
                <p><strong>Duration:</strong> 155 Min</p>
                <p><strong>Category:</strong> IMAX, 2D</p>
                <p><strong>Actor:</strong> Timothée Chalamet, Zendaya, Rebecca Ferguson</p>
                <p><strong>Genre:</strong> Sci-Fi, Drama</p>
                <p><strong>Release:</strong> March 15, 2024</p>
                <p><strong>Language:</strong> English</p>
                <div class="actions">
                        <a href="https://www.youtube.com/watch?v=Way9Dexny3w">
                        <button>Watch Trailer</button>
                    </a>    
                </div>
            </div>
        </div>

        <!-- Movie 3 -->
        <div class="movie-card">
            <img src="../Images/Jawan 2.png" alt="Jawan">
            <div class="movie-info">
                <h2>Jawan 2</h2>
                <p><strong>Rating:</strong> Not Yet Rated</p>
                <p><strong>Duration:</strong> 140 Min</p>
                <p><strong>Category:</strong> 2D</p>
                <p><strong>Actor:</strong> Shah Rukh Khan, Nayanthara</p>
                <p><strong>Genre:</strong> Action, Thriller</p>
                <p><strong>Release:</strong> June 2024</p>
                <p><strong>Language:</strong> Hindi</p>
                <div class="actions">
                        <a href="https://www.youtube.com/watch?v=MWOlnZSnXJo">
                        <button>Watch Trailer</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Movie 4 -->
        <div class="movie-card">
            <img src="../Images/Deadpool.png" alt="Deadpool 3">
            <div class="movie-info">
                <h2>Deadpool 3</h2>
                <p><strong>Rating:</strong> Not Yet Rated</p>
                <p><strong>Duration:</strong> 120 Min</p>
                <p><strong>Category:</strong> 2D, IMAX</p>
                <p><strong>Actor:</strong> Ryan Reynolds, Hugh Jackman</p>
                <p><strong>Genre:</strong> Action, Comedy</p>
                <p><strong>Release:</strong> May 3, 2024</p>
                <p><strong>Language:</strong> English</p>
                <div class="actions">
                        <a href="https://www.youtube.com/watch?v=73_1biulkYk">
                        <button>Watch Trailer</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Movie 5 -->
        <div class="movie-card">
            <img src="../Images/KGF3.png" alt="KGF Chapter 3">
            <div class="movie-info">
                <h2>KGF Chapter 3</h2>
                <p><strong>Rating:</strong> Not Yet Rated</p>
                <p><strong>Duration:</strong> 150 Min</p>
                <p><strong>Category:</strong> 2D</p>
                <p><strong>Actor:</strong> Yash, Srinidhi Shetty</p>
                <p><strong>Genre:</strong> Action, Drama</p>
                <p><strong>Release:</strong> October 2024</p>
                <p><strong>Language:</strong> Kannada</p>
                <div class="actions">
                        <a href="https://www.youtube.com/watch?v=NR9PVUaZPI4">
                        <button>Watch Trailer</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
