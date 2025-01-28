<?php
session_start();

if (isset($_POST['logout'])) {
    // Destroy the session
    session_unset();
    session_destroy();

    // Redirect to the login page
    header("Location: index.php");
    exit();
}

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'logout' => $_SESSION['logout_error'] ?? ''
];

$activeForm = $_SESSION['active_form'] ?? 'login';

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="box <?= isActiveForm('logout', $activeForm); ?>" id="logout-form">
        <h1>Welcome, <span><?= $_SESSION['name'] ?? 'Guest'; ?></span></h1>
        <p>This is an <span>user</span> page</p>
        <form action="" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>

</body>
</html>