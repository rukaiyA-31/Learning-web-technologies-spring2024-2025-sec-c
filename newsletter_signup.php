<?php
session_start();

// Check if the user is logged in, either via session or cookie
if (!isset($_SESSION['user']) && !isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the username from the session or cookie
$username = isset($_SESSION['user']) ? $_SESSION['user'] : $_COOKIE['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Signup</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>! Subscribe to our Newsletter</h2>

    <!-- Newsletter Signup Form -->
    <form action="subscribe.php" method="POST">
        <input type="email" name="email" placeholder="Your email address" required><br>
        <label>
            <input type="checkbox" name="consent" required>
            I agree to receive emails and accept the privacy policy.
        </label><br>
        <button type="submit">Subscribe</button>
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>
