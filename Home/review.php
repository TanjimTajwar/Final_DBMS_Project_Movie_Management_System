<?php
session_start();

// Assuming the user is logged in and their username is stored in the session
if (!isset($_SESSION['username'])) {
    echo "You need to log in first.";
    exit;
}

$username = $_SESSION['username'];

// Database connection
$servername = "localhost"; // Adjust with your database details
$username_db = "root"; // Adjust with your database username
$password_db = ""; // Adjust with your database password
$dbname = "dbms"; // The database name you created

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching movie titles for the select options
$sql = "SELECT title FROM Movie";
$result = $conn->query($sql);
$movies = [];
while ($row = $result->fetch_assoc()) {
    $movies[] = $row['title'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $movie_title = $_POST['movie_title'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $review_date = date('Y-m-d H:i:s'); // Format current date and time for DATETIME

    // Prepare SQL query to insert the review
    $query = "INSERT INTO Review (username, movie_title, rating, comment, review_date) 
              VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssiss", $username, $movie_title, $rating, $comment, $review_date);

    if ($stmt->execute()) {
        // Redirect to myReview page after successful insertion
        header("Location: ../User_Dashboard/myReview.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Movie</title>
    <link rel="stylesheet" href="../css/review.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">Movie Review System</div>
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
    </div>

    <div class="review-form">
        <h2>Submit Your Review</h2>
        <form action="" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>

            <label for="movie_title">Select Movie</label>
            <select id="movie_title" name="movie_title" required>
                <?php foreach ($movies as $movie): ?>
                    <option value="<?php echo $movie; ?>"><?php echo $movie; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="rating">Rating (1-10)</label>
            <input type="number" id="rating" name="rating" min="1" max="10" required>

            <label for="comment">Comment</label>
            <textarea id="comment" name="comment" rows="4" required></textarea>

            <label for="review_date">Review Date</label>
            <input type="text" id="review_date" name="review_date" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>

            <input type="submit" value="Submit Review">
        </form>
    </div>
</body>
</html>
