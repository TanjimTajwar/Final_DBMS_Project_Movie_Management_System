<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobra Movies - Homepage</title>
    <style>
        /* Basic reset for padding and margin */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        /* Set background image */
        body {
            background-image: url('../Algo/Images/index.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        /* Navbar styling */
        .navbar {
            position: absolute;
            top: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 10px;
            text-align: center;
        }
        .navbar h1 {
            font-size: 2.5rem;
            color: white;
            margin: 0;
        }
        /* Centered container for buttons */
        .content {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 30px;
            border-radius: 10px;
        }
        .btn {
            background-color: #4CAF50; 
            border: none; 
            color: white;
            padding: 20px 40px;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 5px;
            margin: 20px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <!-- Navbar with the name of the college -->
    <div class="navbar">
        <h1>Jobra Movies</h1>
    </div>

    <!-- Content with the two buttons -->
    <div class="content">
        <h2>Welcome to Jobra Movies Portal</h2>
        <p>Choose your login type</p>
        <!-- Button to login as student -->
        <a href="../algo/loginpage/loginpage.php">
            <button class="btn">Login as User</button>
        </a>
        <!-- Button to login as admin -->
        <a href="../algo/Admin_Dashboard/Admin_login.php">
            <button class="btn">Login as Admin</button>
        </a>
    </div>

</body>
</html>
