<?php if (!isset($cpage)) {$cpage="";} ?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand">Daniel Valent</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link<?php if ($cpage == "index") {echo " active";} ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle<?php if ($cpage == "projects") {echo " active";} ?>" href="projects.php" role="button" data-bs-toggle="dropdown">Projects</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="projects.php#Project_1">Project 1</a></li>
                        <li><a class="dropdown-item" href="projects.php#Project_2">Project 2</a></li>
                        <li><a class="dropdown-item" href="projects.php#Project_3">Project 3</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if ($cpage == "about") {echo " active";} ?>" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if ($cpage == "register") {echo " active";} ?>" href="register.php">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>