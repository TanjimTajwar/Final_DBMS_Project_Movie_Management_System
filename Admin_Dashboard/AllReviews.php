<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$host = 'localhost';
$dbname = 'dbms';
$username = 'root';
$password = '';  // Use your password here

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch review data
$query = "SELECT 
            Review.review_id, 
            Review.username, 
            Review.movie_title, 
            Review.rating, 
            Review.comment, 
            Review.review_date 
          FROM Review
          ORDER BY Review.review_date DESC";

$result = mysqli_query($conn, $query);

// Check if query was successful
if (!$result) {
    die("Error fetching reviews: " . mysqli_error($conn));
}

// Fetch all reviews
$reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reviews</title>
    <style>
        /* General Reset */
        body, h1, h2, h3, p, ul, li {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            background-color: #4A0000;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .header .logo a {
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
        }

        .header nav ul {
            list-style: none;
            display: flex;
        }

        .header nav ul li {
            margin: 0 10px;
        }

        .header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .header nav ul li a:hover {
            text-decoration: underline;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #4A0000;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: left;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
        }

        th {
            background-color: #4A0000;
            color: white;
        }

        td a {
            color: red;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        .logout-link {
            text-align: center;
            margin-top: 20px;
        }

        .logout-link a {
            text-decoration: none;
            color: #4A0000;
            font-weight: bold;
        }

        .logout-link a:hover {
            text-decoration: underline;
        }
    </style>
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

    <div>
        <h1>All Reviews</h1>
        <table>
            <thead>
                <tr>
                    <th>Review ID</th>
                    <th>Username</th>
                    <th>Movie Title</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Review Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $review): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($review['review_id']); ?></td>
                            <td><?php echo htmlspecialchars($review['username']); ?></td>
                            <td><?php echo htmlspecialchars($review['movie_title']); ?></td>
                            <td><?php echo htmlspecialchars($review['rating']); ?></td>
                            <td><?php echo htmlspecialchars($review['comment']); ?></td>
                            <td><?php echo htmlspecialchars($review['review_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No reviews available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="logout-link">
            <a href="../admin_dashboard/admin_dashboard.php">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>

<?php
// Close the connection
mysqli_close($conn);
?>
