<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username         = trim($_POST['username']);
    $email            = trim($_POST['email']);
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $errors = [];

    // Validate Username
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    // Validate Email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }

    // Validate Password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    // Validate Confirm Password
    if (empty($confirm_password)) {
        $errors[] = "Confirm password is required.";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Final check
    if (empty($errors)) {
        // All validations passed
        echo "<h3>Welcome, " . htmlspecialchars($username) . "!</h3>";
        echo "<p>Your registration was successful.</p>";
    } else {
        // Show errors
        echo "<h3>Registration Failed:</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    }
} else {
    echo "Invalid request method.";
}
?>
