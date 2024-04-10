<?php
session_start();
require('connection.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['felhasznalo_id'];

if (isset($_POST['confirm_booking'])) {
    // Ellenőrizd, hogy a POST adatok léteznek-e
    if(isset($_POST['checkin'], $_POST['checkout'], $_POST['szoba_tipus'], $_POST['kedvezmeny'], $_POST['payment_options'])) {
        $checkinDate = $_POST['checkin'];
        $checkoutDate = $_POST['checkout'];
        $selectedRoomTypeText = $_POST['szoba_tipus'];
        $selectedDiscountText = $_POST['kedvezmeny'];
        $paymentOption = $_POST['payment_options'];

        // Ellenőrizd, hogy az adott szoba típus létezik-e
        $sql_szoba = "SELECT szoba_id FROM szoba_tipusok WHERE nev = '$selectedRoomTypeText'";
        $result_szoba = DataBase::$conn->query($sql_szoba);

        if ($result_szoba && $result_szoba->num_rows > 0) {
            $row_szoba = $result_szoba->fetch_assoc();
            $szoba_id = $row_szoba['szoba_id'];

            // Beszúrás az adatbázisba
            $sql_insert = "INSERT INTO foglalas (felhasznalo_id, mettol, meddig, szoba_id, fizetes_mod, fizetes_idopontja, kedvezmeny_id) 
                           VALUES ('$user_id', '$checkinDate', '$checkoutDate', '$szoba_id', '$paymentOption', NOW(), '$selectedDiscountText')";
            
            if (DataBase::$conn->query($sql_insert) === TRUE) {
                echo "Sikeresen hozzáadva az adatbázishoz.";
            } else {
                echo "Hiba az adatbázisba való beszúrás során: " . DataBase::$conn->error;
            }
        } else {
            echo "Nincs ilyen szoba a rendszerben.";
        }
    } else {
        echo "Hiányzó adatok a foglaláshoz.";
    }
}
?>
