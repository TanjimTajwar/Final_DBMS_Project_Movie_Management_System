<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Movie Booked</title>
    <link rel="stylesheet" href="../css/aboutUss.css"> <!-- Link your CSS file -->
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
        <h2>Total Movies</h2>

        <!-- Add Movie Form -->
        <form method="POST" action="" style="margin-bottom: 20px;">
            <h3>Add New Movie</h3>
            <label>Title: <input type="text" name="title" required></label>
            <label>Genre: <input type="text" name="genre" required></label>
            <label>Duration: <input type="time" name="duration" required></label>
            <label>Release Date: <input type="date" name="release_date" required></label>
            <label>Language: <input type="text" name="language" required></label>
            <button type="submit" name="add_movie" style="background-color: #4A0000; color: white; border: none; padding: 5px 10px; cursor: pointer;">Add Movie</button>
        </form>

        <!-- Display Movies -->
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Duration</th>
                    <th>Release Date</th>
                    <th>Language</th>
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

                // Handle adding a movie
                if (isset($_POST['add_movie'])) {
                    $title = $conn->real_escape_string($_POST['title']);
                    $genre = $conn->real_escape_string($_POST['genre']);
                    $duration = $conn->real_escape_string($_POST['duration']);
                    $release_date = $conn->real_escape_string($_POST['release_date']);
                    $language = $conn->real_escape_string($_POST['language']);

                    $addSql = "INSERT INTO Movie (title, genre, duration, release_date, language) 
                               VALUES ('$title', '$genre', '$duration', '$release_date', '$language')";

                    if ($conn->query($addSql) === TRUE) {
                        echo "<script>alert('Movie added successfully!'); window.location.href='TotalMovieBooked.php';</script>";
                    } else {
                        echo "<script>alert('Error adding movie: " . $conn->error . "');</script>";
                    }
                }

                // Fetch movies
                $sql = "SELECT * FROM Movie";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['title']) . "</td>
                            <td>" . htmlspecialchars($row['genre']) . "</td>
                            <td>" . htmlspecialchars($row['duration']) . "</td>
                            <td>" . htmlspecialchars($row['release_date']) . "</td>
                            <td>" . htmlspecialchars($row['language']) . "</td>
                            <td>
                                <form method='POST' action=''>
                                    <input type='hidden' name='title' value='" . htmlspecialchars($row['title']) . "'>
                                    <button type='submit' name='delete_movie' style='background-color: #4A0000; color: white; border: none; padding: 5px 10px; cursor: pointer;'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No movies found.</td></tr>";
                }

                // Handle deleting a movie
                if (isset($_POST['delete_movie'])) {
                    $title = $conn->real_escape_string($_POST['title']);
                    $deleteSql = "DELETE FROM Movie WHERE title = '$title'";
                    if ($conn->query($deleteSql) === TRUE) {
                        echo "<script>alert('Movie deleted successfully!'); window.location.href='TotalMovieBooked.php';</script>";
                    } else {
                        echo "<script>alert('Error deleting movie: " . $conn->error . "');</script>";
                    }
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
