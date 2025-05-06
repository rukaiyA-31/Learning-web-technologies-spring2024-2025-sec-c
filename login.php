<?php
session_start();

// Hardcoded credentials for demonstration
$stored_username = 'admin';
$stored_password = 'password123'; // In real apps, store hashed passwords

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    header("Location: newsletter.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Authenticate user
    if ($username === $stored_username && $password === $stored_password) {
        $_SESSION['user'] = $username;
        
        // Set a cookie to remember the user for 30 days
        if (isset($_POST['remember_me'])) {
            setcookie('username', $username, time() + (86400 * 30), "/"); // 30 days
        }

        header("Location: newsletter.php");
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
    <title>Login - Blog Platform</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <label>
            Remember me
            <input type="checkbox" name="remember_me">
        </label><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
