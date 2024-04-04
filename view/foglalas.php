<?php
session_start();
require('connection.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['email'];
$user_id = $_SESSION['felhasznalo_id'];

if (isset($_POST['confirm_booking'])) {
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $szoba_tipus = $_POST['szoba_tipus'];
    $kedvezmeny = $_POST['kedvezmeny'];
    $payment_options = $_POST['payment_options'];

    $sql_szoba = "SELECT szoba_id FROM szoba_tipusok WHERE nev = '$szoba_tipus'";
    $result_szoba = DataBase::$conn->query($sql_szoba);

    if ($result_szoba->num_rows > 0) {
        $row_szoba = $result_szoba->fetch_assoc();
        $szoba_id = $row_szoba['szoba_id'];

        $sql_insert = "INSERT INTO foglalas (felhasznalo_id, mettol, meddig, szoba_id, fizetes_mod, fizetes_idopontja, kedvezmeny_id) 
                       VALUES ('$user_id', '$checkin', '$checkout', '$szoba_id', '$payment_options', ".date("h:i:sa").", '$kedvezmeny')";
        
        if (DataBase::$conn->query($sql_insert) === TRUE) {
            echo "Sikeresen hozzáadva az adatbázishoz.";
        } else {
            echo "Hiba az adatbázisba való beszúrás során: " . DataBase::$conn->error;
        }
    } else {
        echo "Nincs ilyen szoba a rendszerben.";
    }
}
?>
