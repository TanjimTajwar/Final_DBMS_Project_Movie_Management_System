<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbms";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the form data
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
    $movie_title = $conn->real_escape_string($_POST['movie_title']);
    $show_time = $conn->real_escape_string($_POST['show_time']);
    $price = $conn->real_escape_string($_POST['price']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $purchase_date = $conn->real_escape_string($_POST['purchase_date']);
    $payment_id = $conn->real_escape_string($_POST['payment_id']);
    $num_tickets = (int) $_POST['num_tickets']; // New field for number of tickets

    // Check if username is available
    if (!$username) {
        echo "<script>alert('You must be logged in to book a ticket!');</script>";
        echo "<script>window.location.href = '../dashboards/user_dashboard.php';</script>";
        exit();
    }

    // Validate the number of tickets
    if ($num_tickets < 1 || $num_tickets > 10) {
        echo "<script>alert('Number of tickets must be between 1 and 10.');</script>";
        echo "<script>window.location.href = 'buy.php';</script>";
        exit();
    }

    // Insert the data into the `moviebooked` table
    $sql = "INSERT INTO moviebooked (username, movie_title, show_time, price, purchase_date, Payment_ID, number_of_tickets) 
            VALUES ('$username', '$movie_title', '$show_time', '$price', '$purchase_date', '$payment_id', '$num_tickets')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to myMovieBooked.php after successful submission
        header("Location: ../User_Dashboard/myMovieBooked.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking - Jobra Movies</title>
    <link rel="stylesheet" href="../CSS/buy.css">
</head>
<body>
    <div class="header">
        <h1 class="logo"><a href="../php/HomePage.php">Jobra Movies</a></h1>
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

    <div class="form-container">
        <form action="../home/buy.php" method="POST">
            <!-- Username -->
            <label>Username:</label>
            <input type="text" name="username" placeholder="Username" readonly value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>">

            <!-- Movie Name -->
            <label>Movie Name:</label>
            <select name="movie_title" required>
                <option value="">Select a Movie</option>
                <option value="Loki">Loki</option>
                <option value="Stree 2: Sarkate Ka Aatank">Stree 2: Sarkate Ka Aatank</option>
                <option value="Pushpa: The Rise - Part 1">Pushpa: The Rise - Part 1</option>
                <option value="Jailer">Jailer</option>
                <option value="Ala Vaikunthapurramuloo">Ala Vaikunthapurramuloo</option>
                <option value="Good Newwz">Good Newwz</option>
                <option value="Bang Chor">Bang Chor</option>
                <option value="Din the Day">Din the Day</option>
            </select>

            <!-- Showtime -->
            <label>Showtime:</label>
            <select name="show_time" required>
                <option value="">Select Showtime</option>
                <option value="Day(12.00)">Day (12:00 PM)</option>
                <option value="After-Noon(3.00)">Afternoon (3:00 PM)</option>
                <option value="Evening(6.00)">Evening (6:00 PM)</option>
                <option value="Night(9.00)">Night (9:00 PM)</option>
            </select>

            <!-- Ticket Type -->
            <label>Ticket Type:</label>
            <select name="price" required>
                <option value="">Select Ticket Type</option>
                <option value="Regular">Regular - 300 TAKA</option>
                <option value="Premium">Premium - 500 TAKA</option>
                <option value="Luxary">Luxury - 1000 TAKA</option>
            </select>

            <!-- Number of Tickets -->
            <label>Number of Tickets:</label>
            <input type="number" name="num_tickets" placeholder="Number of Tickets" required min="1" max="10">

            <!-- Mobile Number -->
            <label>Mobile Number:</label>
            <input type="text" name="mobile" placeholder="Mobile Number" required>

            <!-- Issue Date -->
            <label>Show Date:</label>
            <input type="date" name="purchase_date" required>

            <!-- Payment ID -->
            <label>Payment ID:</label>
            <input type="text" name="payment_id" placeholder="Pay in 017135251** by bkash or nagad then write Transaction ID" required>

            <!-- Submit Button -->
            <button type="submit">Book Ticket</button>
        </form>
    </div>
</body>
</html>
