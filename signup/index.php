<?php
include ('connection.php');
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1">
    <title>Szállásfoglalás</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FU">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="form">
        <h1 id="heading">Regisztráció<h1>
            <form name= "form" action="signup.php" method="POST">
                <i class="fa-solid fa-user"></i>
                <input type ="text" id="firstusername" name="firstusername" placeholder="Add meg a Vezetékneved..." required><br><br>

                <i class="fa-solid fa-user"></i>
                <input type ="text" id="secondusername" name="secondusername" placeholder="Add meg a Keresztneved..." required><br><br>

                <i class="fa-solid fa-envelope"></i> 
                <input type ="email" id="email" name="email" placeholder="Add meg az email címed..." required><br><br>

                <i class ="fa-solid fa-phone"></i>
                <input type="text" id="phone" name="number" placeholder="Add meg a telefonszámod... (+36)" pattern="[0-9]+" required title="Csak szám megadása lehetséges"><br><br>

                <i class="fa-solid fa-lock"></i> 
                <input type ="password" id="pass" name="pass" placeholder="Add meg a jelszavad..." required><br><br>
                
                <i class ="fa-solid fa-lock"></i>
                <input type ="password" id="cpass" name="cpass" placeholder="Jelszó megerősítése..." required><br><br>
                <input type ="submit" id="btn" value="SignUp" name="submit" required><br><br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3"><><>
</body>
</html> 