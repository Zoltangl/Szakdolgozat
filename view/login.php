<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <title>HappyHotel</title>
    <link rel="icon" href="img/logo.jpg" type="image/jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-9ndCyUaIbzAi2FU">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/loginandregister.css">
</head>
<body>

<div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <h1 class="m-0 text-primary text-uppercase">HappyHotel</h1>
                    </a>
                </div>

    <div id="form">
        <h1 id="heading">Regisztráció<h1>
        <form name="form" method="post" action="index.php">

            <i class="fa-solid fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Add meg az email címed..." required><br><br>



            <i class="fa-solid fa-lock"></i>
            <input type="password" id="pass" name="pass" placeholder="Add meg a jelszavad..." required><br><br>

            <div style="text-align: center;">
            <input type="submit" id="btn" value="Bejelentkezés" name="submit" required><br><br>
        </div>
    </form>

    <!-- A "Belépés" link -->
    <div style="text-align: center;">
        <div id="atvalt" class="signup-link">Még nincs fiókod? <a href="signup.php">Regisztráció</a></div>
    </div>
</div>
</body>
</html>
