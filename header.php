<?php if (!isset($cpage)) {
    $cpage = "";
}
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daniel Valent - Index</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="style.css" rel="stylesheet">
</head>
<body>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand">Daniel Valent</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link<?php if ($cpage == "index") {
                        echo " active";
                    } ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle<?php if ($cpage == "projects") {
                        echo " active";
                    } ?>" href="projects.php" role="button" data-bs-toggle="dropdown">Projects</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="projects.php#Project_1">Project 1</a></li>
                        <li><a class="dropdown-item" href="projects.php#Project_2">Project 2</a></li>
                        <li><a class="dropdown-item" href="projects.php#Project_3">Project 3</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if ($cpage == "about") {
                        echo " active";
                    } ?>" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if ($cpage == "register") {
                        echo " active";
                    } ?>" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if ($cpage == "login") {
                        echo " active";
                    } ?>" href="login.php">Login</a>
                </li>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                    echo '<li class="nav-item">
                        <a class="nav-link" href="logout.php">';
                    echo $_SESSION['user_name'];
                    echo '</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="change_password.php" ';
                    if ($cpage == "change_password") {
                        echo " active";
                    }
                    echo '>Change password</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="delete_account.php"';
                    if ($cpage == "delete_account") {
                        echo " active";
                    }
                    echo '>Delete account</a></li>';
                }
                ?>

            </ul>
        </div>
    </div>
</nav>
