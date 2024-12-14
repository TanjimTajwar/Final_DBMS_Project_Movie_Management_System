<?php
session_start();

// Check if form is submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hardcoded admin credentials
    $adminUsername = "Arnab";
    $adminPassword = "22701066";

    // Validate credentials
    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['admin_logged_in'] = true; // Set session for logged-in admin
        header("Location: admin_dashboard.php"); // Redirect to dashboard
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Body and Background */
        body {
            background: url('../Images/UserAccount.png') no-repeat center center/cover;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Login Container */
        .container {
            background-color: rgba(0, 0, 0, 0.7);
            width: 400px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Header Styling */
        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            color: #ffcc00;
            font-size: 24px;
            font-weight: bold;
        }

        /* Form Styling */
        .form-container {
            padding: 20px;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: white;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            color: black;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input::placeholder {
            color: #aaa;
        }

        .submit-btn {
            background-color: #4A0000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-transform: uppercase;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #800000;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .user-login-link {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
        }

        .user-login-link a {
            color: #ffcc00;
            text-decoration: none;
        }

        .user-login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Admin Login</h1>
        </header>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST" action="" class="form-container">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <button type="submit" name="login" class="submit-btn">Login</button>
            <div class="user-login-link">
                Login As a user, <a href="../loginpage/loginpage.php">Click Here</a>
            </div>
        </form>
    </div>
</body>
</html>
