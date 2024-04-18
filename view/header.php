<?php
$profile_display = "<a href='signup.php' class='nav-item nav-link'>Regisztráció/Bejelentkezés</a>";

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $profile_display = '<div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Profil
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="foglalasaim.php">Foglalásaim megtekintése</a></li>
                                <li><a id="logout_link" class="dropdown-item" href="logout.php">Kijelentkezés</a></li>
                            </ul>
                        </div>';
}

if (isset($_GET['logout'])) {
    $_SESSION['loggedin'] = false;
    header("Location: login.php");
    exit();
}
?>

<div class="container-fluid bg-dark px-0">
    <div class="row gx-0">
        <div class="col-lg-3 bg-dark d-none d-lg-block">
            <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                <h1 class="m-0 text-primary text-uppercase">HappyHotel</h1>
            </a>
        </div>
        <div class="col-lg-9">
            <div class="row gx-0 bg-white d-none d-lg-flex">
                <div class="col-lg-7 px-5 text-start">
                    <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                        <i class="fa fa-envelope text-primary me-2"></i>
                        <p class="mb-0">HappyHotel@gamil.com</p>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center py-2">
                        <i class="fa fa-phone-alt text-primary me-2"></i>
                        <p class="mb-0">+36 20 523 4270</p>
                    </div>
                </div>
                <div class="col-lg-5 px-5 text-end">
                    <div class="d-inline-flex align-items-center py-2">
                        <a class="me-3" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a class="me-3" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                        <a class="me-3" href="https://hu.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        <a class="me-3" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" class="me-3" href="https://youtu.be/dQw4w9WgXcQ?si=o20Z4PnRRefLHeiO"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                <a href="index.php" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 text-primary text-uppercase">HappyHotel</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Kezdőlap</a>
                        <a href="about.php" class="nav-item nav-link">Rólunk</a>
                        <a href="service.php" class="nav-item nav-link">Szolgáltatásaink</a>
                        <a href="room.php" class="nav-item nav-link">Szobák</a>
                        <a href="booking.php" class="nav-item nav-link">Foglalás</a>
                        <?php echo $profile_display; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
