<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete user request
if (isset($_GET['delete'])) {
    $userToDelete = $_GET['delete'];

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Delete reviews by the user
        $conn->query("DELETE FROM Review WHERE username = '$userToDelete'");
        // Delete tickets booked by the user
        $conn->query("DELETE FROM Ticket WHERE username = '$userToDelete'");
        // Delete user
        $conn->query("DELETE FROM AccountUser WHERE username = '$userToDelete'");

        // Commit transaction
        $conn->commit();
        echo "<script>alert('User and associated data deleted successfully!');</script>";
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        echo "<script>alert('Failed to delete user: " . $e->getMessage() . "');</script>";
    }
}

// Fetch all users
$result = $conn->query("SELECT * FROM AccountUser");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About User</title>
    <style>
        <?php include '../CSS/CommingSoon.css'; ?>
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">Movie Management</div>
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

    <div class="movie-list">
        <table border="1" style="width: 80%; text-align: center; background-color: white; margin: auto; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
            <thead style="background-color: #500000; color: white;">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['username']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['phone']}</td>
                                <td>
                                    <a href='AboutUser.php?delete={$row['username']}' onclick='return confirm(\"Are you sure you want to delete this user?\");'>
                                        <button class='actions'>Delete</button>
                                    </a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
