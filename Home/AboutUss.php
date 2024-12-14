<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Jobra Movies</title>
    <link rel="stylesheet" href="../CSS/AboutUss.css">
</head>
<body>
    <div class="header">
        <h1 class="logo"><a href="../Html/HomePage.php">Jobra Movies</a></h1>
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
    </div>

    <section class="about-section">
        <h2>About Us</h2>
        <div class="owner-info">
            <h3>Hall Owner Information</h3>
            <p>Our theater is proudly owned by Mr. Karim Ahmed, a passionate entrepreneur and cinema enthusiast who has dedicated himself to bringing the best movie-watching experience to Chittagong. Mr. Karim has over 15 years of experience in managing entertainment venues and is a key figure in the local community.</p>
        </div>

        <div class="location-info">
            <h3>Location</h3>
            <p>Jobra Movies is located in the heart of Chittagong, near the scenic Foy’s Lake area. Our address is:</p>
            <p><strong>Jobra Movies Complex, Bay Terminal Road, Chittagong, Bangladesh</strong></p>
        </div>

        <div class="hall-details">
            <h3>Our Halls</h3>
            <div class="hall">
                <h4>Hall Name: Alfa</h4>
                <p><strong>Floor:</strong> Ground Floor</p>
                <p><strong>Total Seats:</strong> 250</p>
                <p><strong>Current Show Running:</strong> Loki</p>
                <p><strong>Show Timings:</strong> 10:50 AM, 2:30 PM, 6:15 PM</p>
                <p><strong>Screen Size:</strong> 70 ft x 40 ft</p>
                <p><strong>Sound System:</strong> Dolby Atmos</p>
                <p><strong>Special Features:</strong> Recliner Seats</p>
            </div>
            <div class="hall">
                <h4>Hall Name: Omega</h4>
                <p><strong>Floor:</strong> 1st Floor</p>
                <p><strong>Total Seats:</strong> 300</p>
                <p><strong>Current Show Running:</strong> Jailer</p>
                <p><strong>Show Timings:</strong> 12:30 PM, 4:00 PM, 7:45 PM</p>
                <p><strong>Screen Size:</strong> 80 ft x 45 ft</p>
                <p><strong>Sound System:</strong> 7.1 Surround Sound</p>
                <p><strong>Special Features:</strong> VIP Lounges</p>
            </div>
            <div class="hall">
                <h4>Hall Name: Lamda</h4>
                <p><strong>Floor:</strong> 2nd Floor</p>
                <p><strong>Total Seats:</strong> 200</p>
                <p><strong>Current Show Running:</strong> Good Newwz</p>
                <p><strong>Show Timings:</strong> 11:00 AM, 3:00 PM, 8:00 PM</p>
                <p><strong>Screen Size:</strong> 60 ft x 35 ft</p>
                <p><strong>Sound System:</strong> DTS:X</p>
                <p><strong>Special Features:</strong> Advanced Lighting</p>
            </div>
            <div class="hall">
                <h4>Hall Name: Sigma</h4>
                <p><strong>Floor:</strong> 3rd Floor</p>
                <p><strong>Total Seats:</strong> 180</p>
                <p><strong>Current Show Running:</strong> Pushpa</p>
                <p><strong>Show Timings:</strong> 9:30 AM, 1:30 PM, 5:30 PM</p>
                <p><strong>Screen Size:</strong> 65 ft x 38 ft</p>
                <p><strong>Sound System:</strong> IMAX Enhanced</p>
                <p><strong>Special Features:</strong> 3D Projection</p>
            </div>
        </div>

        <div class="maker-info">
            <h3>About the Maker</h3>
            <p><strong>Name:</strong> Tanjim Tajwar Arnab</p>
            <p><strong>Job:</strong> Student</p>
            <p><strong>Department:</strong> Computer Science and Engineering</p>
            <p><strong>Session:</strong> 21-22</p>
            <p><strong>ID:</strong> 22701066</p>
            <p><strong>Age:</strong> 22</p>
        </div>
    </section>
</body>
</html>
