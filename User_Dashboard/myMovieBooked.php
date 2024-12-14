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

// Handle delete booking
if (isset($_POST['delete'])) {
    $seatNumber = $_POST['seat_number'];

    // Delete the booking record
    $stmt = $conn->prepare("DELETE FROM moviebooked WHERE seat_number = ? AND username = ?");
    $stmt->bind_param("is", $seatNumber, $currentUser);
    $stmt->execute();
    $stmt->close();
}

// Fetch all booked movies for the current user
$stmt = $conn->prepare("
    SELECT 
        moviebooked.seat_number, 
        moviebooked.movie_title, 
        moviebooked.show_time, 
        moviebooked.price, 
        moviebooked.purchase_date, 
        moviebooked.Payment_ID,
        moviebooked.number_of_tickets -- New column added
    FROM moviebooked
    WHERE moviebooked.username = ?
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
    <title>My Booked Movies</title>
    <style>
        <?php include '../CSS/CommingSoon.CSS'; ?>
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
            <h1>My Booked Movies</h1>
        </header>
        <table border="1" cellspacing="0" cellpadding="10" style="width: 100%; background-color: white; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th>Movie Title</th>
                    <th>Show Time</th>
                    <th>Price</th>
                    <th>Show Date</th>
                    <th>Payment ID</th>
                    <th>Number of Tickets</th> <!-- New column added -->
                    <th>Cancel Booking</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['movie_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['show_time']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td><?php echo htmlspecialchars($row['purchase_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['Payment_ID']); ?></td>
                            <td><?php echo htmlspecialchars($row['number_of_tickets']); ?></td> <!-- New column displayed -->
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="seat_number" value="<?php echo $row['seat_number']; ?>">
                                    <button type="submit" name="delete" class="actions button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">No bookings found.</td> <!-- Updated colspan -->
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
