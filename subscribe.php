<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user']) && !isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit();
}

// Simulate subscribing the user to the newsletter
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $consent = isset($_POST['consent']) ? true : false;

    if ($consent) {
        echo "<p>Thanks for subscribing, " . htmlspecialchars($email) . "! Please check your email to confirm your subscription.</p>";
    } else {
        echo "<p>You must agree to receive emails.</p>";
    }
}
?>
