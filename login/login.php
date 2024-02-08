<?php
include("connection.php");



if(isset($_POST['submit2'])){
    $email = $_POST['email'];
    $password = $_POST['pass'];

    $sql =  "select * from felhasznalo where email = '$email' and password = '$password'";  
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if($count == 1){
    header("Sikeres belépés!");
    }
    else{
        echo '<script>
        window.location.href = "index.php";
        alert("Hibás email-cím vagy jelszó!")
        </script>';
    }
}
?>
