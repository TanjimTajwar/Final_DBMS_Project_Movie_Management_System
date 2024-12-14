<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: UserLogin.php");
    exit();
}

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentUser = $_SESSION['username'];

// Handle delete review
if (isset($_POST['delete'])) {
    $reviewId = $_POST['review_id'];

    // Delete the review record
    $stmt = $conn->prepare("DELETE FROM review WHERE review_id = ? AND username = ?");
    $stmt->bind_param("is", $reviewId, $currentUser);
    $stmt->execute();
    $stmt->close();
}

// Fetch all reviews for the current user
$stmt = $conn->prepare("
    SELECT 
        review.review_id, 
        review.movie_title, 
        review.rating, 
        review.comment, 
        review.review_date 
    FROM review
    WHERE review.username = ?
");
$stmt->bind_param("s", $currentUser);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reviews</title>
    <style>
        <?php include '../css/CommingSoon.css'; ?>
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">MyMovies</div>
        <ul>
            <li><a href="../home/homepage.php">Homepage</a></li>
            <li><a href="../User_Dashboard/myMovieBooked.php">Ticket</a></li>
            <li><a href="../User_Dashboard/User_dashboard.php">Dashboard</a></li>
            <li><a href="../User_Dashboard/myReview.php">Review</a></li>
            <li><a href="../loginpage/loginpage.php">Log out</a></li>
        </ul>
    </div>
    <div class="container">
        <header>
            <h1>My Reviews</h1>
        </header>
        <table border="1" cellspacing="0" cellpadding="10" style="width: 100%; background-color: white; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th>Movie Title</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Review Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['movie_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['rating']); ?></td>
                            <td><?php echo htmlspecialchars($row['comment']); ?></td>
                            <td><?php echo htmlspecialchars($row['review_date']); ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="review_id" value="<?php echo $row['review_id']; ?>">
                                    <button type="submit" name="delete" class="actions button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No reviews found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
