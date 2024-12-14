<?php
// Database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dbms';

// Establish a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle user deletion if requested
if (isset($_GET['delete'])) {
    $deleteUsername = $conn->real_escape_string($_GET['delete']);
    $deleteQuery = "DELETE FROM AccountUser WHERE username = '$deleteUsername'";
    if ($conn->query($deleteQuery)) {
        echo "<script>alert('User deleted successfully!'); window.location.href = 'admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting user.');</script>";
    }
}

// Fetch all users from the AccountUser table
$sql = "SELECT * FROM AccountUser";
$result = $conn->query($sql);

// Store users in an array
$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    // Perform logout actions, like destroying the session
    echo "<script>alert('Logged out successfully!'); window.location.href = '../loginPage/loginpage.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">
            <a href="../admin_dashboard/admin_dashboard.php"  style="color: white;">Admin Panel</a>
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

    <!-- Main Container -->
    <div class="container">
        <h2>User Information</h2>

        <!-- Display user information in a table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($users) > 0): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                            <td>
                                <a href="?delete=<?= urlencode($user['username']) ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
