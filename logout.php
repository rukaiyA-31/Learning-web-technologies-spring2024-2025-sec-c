<?php
session_start();

// Destroy session and remove cookies
session_unset();
session_destroy();
setcookie('username', '', time() - 3600, "/"); // Remove the cookie

header("Location: login.php");
exit();
?>

