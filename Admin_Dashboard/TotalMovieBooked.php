<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Movie Booked</title>
    <link rel="stylesheet" href="../CSS/AboutUss.css"> <!-- Link your CSS file -->
</head>
<body>
    <!-- Navbar -->
    <header class="header">
        <div class="logo">
            <a href="../admin_dashboard/admin_dashboard.php">Admin Panel</a>
        </div>
        <nav>
            <ul>
                <li><a href="../admin_dashboard/admin_dashboard.php">UserInfo</a></li>
                <li><a href="../admin_dashboard/TotalMovieBooked.php">Ticket Booked</a></li>
                <li><a href="../admin_dashboard/Allreviews.php">Reviews</a></li>
                <li><a href="../admin_dashboard/Movie_List.php">Movie List</a></li>
                <li><a href="../loginPage/loginpage.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="about-section">
        <h2>Total Movie Booked</h2>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>User Who Booked</th>
                    <th>Number of Tickets</th>
                    <th>Show Time</th>
                    <th>Payment ID</th> <!-- New Column -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'dbms');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch booking data
                $sql = "
                SELECT 
                    moviebooked.movie_title AS title, 
                    moviebooked.username AS user, 
                    SUM(moviebooked.number_of_tickets) AS total_tickets, 
                    moviebooked.show_time, 
                    GROUP_CONCAT(DISTINCT moviebooked.Payment_ID SEPARATOR ', ') AS payment_ids
                FROM moviebooked 
                GROUP BY moviebooked.movie_title, moviebooked.username, moviebooked.show_time;
                ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['title']) . "</td>
                            <td>" . htmlspecialchars($row['user']) . "</td>
                            <td>" . htmlspecialchars($row['total_tickets']) . "</td>
                            <td>" . htmlspecialchars($row['show_time']) . "</td>
                            <td>" . htmlspecialchars($row['payment_ids']) . "</td> <!-- Display Payment IDs -->
                            <td>
                                <form method='POST' action='TotalMovieBooked.php'>
                                    <input type='hidden' name='title' value='" . htmlspecialchars($row['title']) . "'>
                                    <input type='hidden' name='username' value='" . htmlspecialchars($row['user']) . "'>
                                    <input type='hidden' name='show_time' value='" . htmlspecialchars($row['show_time']) . "'>
                                    <button type='submit' name='delete' style='background-color: #4A0000; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No bookings found.</td></tr>";
                }

                // Handle deletion
                if (isset($_POST['delete'])) {
                    $title = $conn->real_escape_string($_POST['title']);
                    $username = $conn->real_escape_string($_POST['username']);
                    $show_time = $conn->real_escape_string($_POST['show_time']);

                    $deleteSql = "
                    DELETE FROM moviebooked 
                    WHERE movie_title = '$title' 
                        AND username = '$username' 
                        AND show_time = '$show_time';
                    ";
                    if ($conn->query($deleteSql) === TRUE) {
                        echo "<script>alert('Booking deleted successfully!'); window.location.href='TotalMovieBooked.php';</script>";
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
