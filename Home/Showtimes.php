<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobra Movies</title>
    <link rel="stylesheet" href="../CSS/showtimes.css">
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
        <!-- Movie 1: Loki -->
        <div class="movie-card">
            <img src="../images/Loki.png" alt="Loki">
            <div class="movie-info">
                <h2>Loki</h2>
                <p><strong>Rating:</strong> 8.3</p>
                <p><strong>Duration:</strong> 147 Min</p>
                <p><strong>Category:</strong> 2D</p>
                <p><strong>Actor:</strong> Tom Hiddleston, Sophia Di Martino, Owen Wilson</p>
                <p><strong>Genre:</strong> Action, Adventure, Fantasy</p>
                <p><strong>Release:</strong> June 9, 2021 (Season 1)</p>
                <p><strong>Language:</strong> English</p>
                <div class="actions">
                    <a href="https://www.youtube.com/watch?v=dug56u8NN7g">
                        <button>Watch Trailer</button>
                    </a>
                </div>
            </div>
            <div class="showtimes">
                <p><strong>Friday</strong> 18th, November 2024</p>
                <button>04:15 PM</button>
                <button>07:45 PM</button>
                <p><strong>Saturday</strong> 19th, November 2024</p>
                <button>05:00 PM</button>
                <button>08:30 PM</button>
            </div>
        </div>

        <!-- Movie 2: Stree 2 -->
        <div class="movie-card">
            <img src="../images/Stree 2.png" alt="Stree 2">
            <div class="movie-info">
                <h2>Stree 2: Sarkate Ka Aatank</h2>
                <p><strong>Rating:</strong> 7.1</p>
                <p><strong>Duration:</strong> 147 Min</p>
                <p><strong>Category:</strong> 2D</p>
                <p><strong>Actor:</strong> Rajkummar Rao, Shraddha Kapoor, Pankaj Tripathi</p>
                <p><strong>Genre:</strong> Horror, Comedy</p>
                <p><strong>Release:</strong> August 2024</p>
                <p><strong>Language:</strong> Hindi</p>
                <div class="actions">
                    <a href="https://www.youtube.com/watch?v=KVnheXywIbY">
                        <button>Watch Trailer</button>
                    </a>
                </div>
            </div>
            <div class="showtimes">
                <p><strong>Friday</strong> 18th, November 2024</p>
                <button>04:45 PM</button>
                <button>07:15 PM</button>
                <p><strong>Saturday</strong> 19th, November 2024</p>
                <button>05:15 PM</button>
                <button>08:45 PM</button>
            </div>
        </div>

        <!-- Movie 3: Pushpa -->
        <div class="movie-card">
            <img src="../images/Pushpa.png" alt="Pushpa">
            <div class="movie-info">
                <h2>Pushpa: The Rise - Part 1</h2>
                <p><strong>Rating:</strong> 7.6</p>
                <p><strong>Duration:</strong> 179 Min</p>
                <p><strong>Category:</strong> 2D</p>
                <p><strong>Actor:</strong> Allu Arjun, Rashmika Mandanna, Fahadh Faasil</p>
                <p><strong>Genre:</strong> Action, Drama</p>
                <p><strong>Release:</strong> December 17, 2021</p>
                <p><strong>Language:</strong> Telugu</p>
                <div class="actions">
                    <a href="https://www.youtube.com/watch?v=ou6h-22tMnA">
                        <button>Watch Trailer</button>
                    </a>
                </div>
            </div>
            <div class="showtimes">
                <p><strong>Friday</strong> 10px8th, December 2024</p>
                <button>05:15 PM</button>
                <button>07:45 PM</button>
                <p><strong>Saturday</strong> 19th, December 2024</p>
                <button>06:00 PM</button>
                <button>08:30 PM</button>
            </div>
        </div>

        <!-- Movie 4: Jailer -->
        <div class="movie-card">
            <img src="../images/Jailer.png" alt="Jailer">
            <div class="movie-info">
                <h2>Jailer</h2>
                <p><strong>Rating:</strong> 8.3</p>
                <p><strong>Duration:</strong> 166 Min</p>
                <p><strong>Category:</strong> 2D</p>
                <p><strong>Actor:</strong> Rajinikanth, Mohanlal, Jackie Shroff, Tamannaah Bhatia</p>
                <p><strong>Genre:</strong> Action, Thriller</p>
                <p><strong>Release:</strong> August 10, 2023</p>
                <p><strong>Language:</strong> Hindi</p>
                <div class="actions">
                    <a href="https://www.youtube.com/watch?v=5VOnM0SPgB8">
                        <button>Watch Trailer</button>
                    </a>
                </div>
            </div>
            <div class="showtimes">
                <p><strong>Friday</strong> 18th, December 2024</p>
                <button>03:15 PM</button>
                <button>05:45 PM</button>
                <p><strong>Saturday</strong> 19th, December 2024</p>
                <button>04:00 PM</button>
                <button>06:30 PM</button>
            </div>
        </div>

        <!-- Movie 5: Ala Vaikunthapurramuloo -->
        <div class="movie-card">
            <img src="../images/Vaikunthapurramuloo.png" alt="Ala Vaikunthapurramuloo">
            <div class="movie-info">
                <h2>Ala Vaikunthapurramuloo</h2>
                <p><strong>Rating:</strong> 7.3</p>
                <p><strong>Duration:</strong> 165 Min</p>
                <p><strong>Category:</strong> 2D</p>
                <p><strong>Actor:</strong> Allu Arjun, Pooja Hegde, Tabu, Jayaram</p>
                <p><strong>Genre:</strong> Action, Drama, Family</p>
                <p><strong>Release:</strong> January 12, 2020</p>
                <p><strong>Language:</strong> Telugu</p>
                <div class="actions">
                    <a href="https://www.youtube.com/watch?v=SkENAjfVoNI">
                        <button>Watch Trailer</button>
                    </a>
                </div>
            </div>
            <div class="showtimes">
                <p><strong>Friday</strong> 18th, December 2024</p>
                <button>04:00 PM</button>
                <button>06:30 PM</button>
                <p><strong>Saturday</strong> 19th, December 2024</p>
                <button>04:45 PM</button>
                <button>07:15 PM</button>
            </div>
        </div>

        <!-- Movie 6: Good Newwz -->
        <div class="movie-card">
            <img src="../images/Good-Newwz.png" alt="Good Newwz">
            <div class="movie-info">
                <h2>Good Newwz</h2>
                <p><strong>Rating:</strong> 7.0</p>
                <p><strong>Duration:</strong> 132 Min</p>
                <p><strong>Category:</strong> 2D</p>
                <p><strong>Actor:</strong> Akshay Kumar, Kareena Kapoor Khan, Diljit Dosanjh, Kiara Advani</p>
                <p><strong>Genre:</strong> Comedy, Drama</p>
                <p><strong>Release:</strong> December 27, 2019</p>
                <p><strong>Language:</strong> Hindi</p>
                <div class="actions">
                    <a href="https://www.youtube.com/watch?v=r9VJpqoAr84">
                        <button>Watch Trailer</button>
                    </a>
                </div>
            </div>
            <div class="showtimes">
                <p><strong>Friday</strong> 18th, December 2024</p>
                <button>02:30 PM</button>
                <button>05:00 PM</button>
                <p><strong>Saturday</strong> 19th, December 2024</p>
                <button>03:00 PM</button>
                <button>05:30 PM</button>
            </div>
        </div>
    </section>

</body>
</html>
