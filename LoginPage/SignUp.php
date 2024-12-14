<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account - Jobra Movies</title>
    <link rel="stylesheet" href="../CSS/Account.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><a href="../Home/HomePage.php">Jobra Movies</a></h1>
        </header>
        <main>
            <div class="form-container">
                <form action="../loginpage/Account.php" method="post">
                    <!-- Username Field -->
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="Username" 
                            placeholder="Choose a unique username" 
                            required>
                        <!-- Display error if username is already taken -->
                        <?php if (isset($_GET['error']) && $_GET['error'] === 'username_taken'): ?>
                            <p style="color: red; font-size: 0.9em;">Username already taken. Please choose another.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Full Name Field -->
                    <div class="form-group">
                        <label for="fullname">Full Name:</label>
                        <input 
                            type="text" 
                            id="fullname" 
                            name="FullName" 
                            placeholder="Enter your full name" 
                            required>
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="Email" 
                            placeholder="example@gmail.com" 
                            required>
                    </div>

                    <!-- Phone Field -->
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="Phone" 
                            placeholder="01xxx-xxxxxx" 
                            pattern="01[0-9]{9}" 
                            required>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="Password" 
                            placeholder="Enter your password" 
                            required>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <center>
                            <button type="submit" class="submit-btn">Register</button>
                        </center>
                    </div>
                </form>

                <!-- Redirect to Login -->
                <center>
                    <p>
                        Already have an account? 
                        <a href="../loginpage/loginpage.php" id="SignUp">Sign in</a>
                    </p>
                </center>
            </div>
        </main>
    </div>
</body>
</html>
