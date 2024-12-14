<?php
session_start();
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

$errorMessage = "";

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Check if username and password are valid
    $stmt = $conn->prepare("SELECT * FROM AccountUser WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $inputUsername, $inputPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Set session variables and redirect to dashboard
        $_SESSION['username'] = $inputUsername;
        header("Location: ../User_dashboard/user_dashboard.php");
        exit();
    } else {
        $errorMessage = "Invalid username or password. Please try again.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        <?php include '../CSS/Account.css'; ?>
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>User Login</h1>
        </header>
        <div class="form-container">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="submit-btn">Login</button>
                </div>
                <p style="text-align: center; color: white;">
                    Don't have an account? 
                    <a href="../Loginpage/Signup.php" id="SignUp">Register</a>
                </p>
                <?php if ($errorMessage): ?>
                    <p style="color: red; text-align: center;"><?php echo $errorMessage; ?></p>
                <?php endif; ?>
                <!-- Admin Link Text -->
                <p style="text-align: center;">
                    Are you an admin? Click<a href="../admin_dashboard/Admin_login.php" style="color: blue;"> here</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
