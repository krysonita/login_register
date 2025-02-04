<?php

session_start();

// Capture session errors
$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];

$activeForm = $_SESSION['active_form'] ?? 'login';

// Clear session errors after retrieving them
session_unset();

// Function to show an error message
function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

// Function to determine the active form
function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}

// Shutdown function to capture fatal errors
function handleShutdown() {
    $error = error_get_last();
    if ($error && ($error['type'] === E_ERROR || $error['type'] === E_PARSE)) {
        echo "<p class='error-message'>A fatal error occurred: {$error['message']} in {$error['file']} on line {$error['line']}</p>";
    }
}

// Register shutdown function
register_shutdown_function('handleShutdown');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full-Stack Login & Register Form With User & Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">

        <!-- Login form -->
        <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
            <form action="login_register.php" method="post">
                <h2>Login</h2>
                <?= showError($errors['login']); ?>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a href="#" onclick="showForm('register-form')">Register</a></p>
            </form>
        </div>

        <!-- Register form -->
        <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
            <form action="login_register.php" method="post">
                <h2>Register</h2>
                <?= showError($errors['register']); ?>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required> 
                <select name="role" required>
                    <option value="">--Select Role--</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a></p>
            </form>
        </div>

    </div>

    <script src="script.js"></script>
</body>

</html>