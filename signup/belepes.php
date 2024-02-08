<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-9ndCyUaIbzAi2FU">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Bejelentkezés</title>
</head>
<body>
<div id="form2">
        <h1 id="heading">Bejelentkezés<h1>
            <form name= "form2" action="login.php" onsubmit="return isvalid()" method ="POST">

                <i class="fa-solid fa-envelope"></i> 
                <input type ="email" id="email" name="email" placeholder="Add meg az email címed..." required><br><br>

                <i class="fa-solid fa-lock"></i> 
                <input type ="password" id="pass" name="pass" placeholder="Add meg a jelszavad..." required><br><br>

                <input type ="submit" id="btn" value="Bejelentkezés" name="submit2" required><br><br>
    </div>
</body>
</html>