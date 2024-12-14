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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Username'];  // Input field name should match with the form
    $name = $_POST['FullName'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $password = $_POST['Password'];

    // Basic form validation
    if (empty($username) || empty($name) || empty($email) || empty($phone) || empty($password)) {
        echo "<script>alert('All fields are required!'); window.location.href = '../loginpage/Account.php';</script>";
        exit();
    }

    // Check if the username already exists in the database
    $sql_check_username = "SELECT username FROM AccountUser WHERE username = ?";
    $stmt = $conn->prepare($sql_check_username);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the username is already taken, redirect back to the registration page
    if ($result->num_rows > 0) {
        header("Location: ../loginpage/Account.php?error=username_taken");
        exit();
    }

    // If username is not taken, proceed to insert the new user
    $hashed_password = $password;

    $sql = "INSERT INTO AccountUser (username, name, email, phone, password) 
            VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $name, $email, $phone, $hashed_password);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href = '../loginpage/loginpage.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
