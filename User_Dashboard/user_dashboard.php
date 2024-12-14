<?php
// Start session
session_start();

// Database connection
$servername = "localhost";  // Change to your database server
$username = "root";         // Your database username
$password = "";       // Your database password
$dbname = "dbms";           // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: UserLogin.php");
    exit();
}

// Fetch user information from the database
$username = $_SESSION['username'];
$query = "SELECT name FROM AccountUser WHERE username = ?";
$stmt = $conn->prepare($query);

// Bind the parameter for the query. We only need one string parameter.
$stmt->bind_param("s", $username);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $name = $user['name'];
} else {
    $name = "Guest";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../css/CommingSoon.css">
    <link rel="stylesheet" href="../css/User_Dashboard.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">User Dashboard</div>
        <ul>
            <li><a href="../home/homepage.php">Homepage</a></li>
            <li><a href="../User_Dashboard/myMovieBooked.php">Ticket</a></li>
            <li><a href="../User_Dashboard/User_dashboard.php">Dashboard</a></li>
            <li><a href="../User_Dashboard/myReview.php">Review</a></li>
            <li><a href="../loginpage/loginpage.php">Log out</a></li> <!-- Ensure logout works -->
        </ul>
    </nav>

    <!-- Welcome Message -->
    <div class="welcome-message" style="text-align: center; margin: 50px auto;">
        <h1>Hello, <?php echo htmlspecialchars($name); ?>!</h1>
        <p>Thanks for logging in.</p>
        <div>Tell me What's On your Mind!</div>
    </div>
    <section class="hero">
        <div class="hero-content">
            <h3>Check The Movies Running Now</h3>
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
</body>
</html>
