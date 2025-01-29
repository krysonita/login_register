<?php
session_start();

// Unset session variables
session_unset();
session_destroy();

// Clear cookies by setting expiration time in the past
setcookie("name", "", time() - 3600, "/");
setcookie("email", "", time() - 3600, "/");
setcookie("role", "", time() - 3600, "/");

// Redirect to login page
header("Location: index.php");
exit();
?>
