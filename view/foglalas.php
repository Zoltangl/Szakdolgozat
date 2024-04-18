<?php
session_start();
require('connection.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['felhasznalo_id'];

if (isset($_POST['confirm_booking'])) {
    if(isset($_POST['checkin'], $_POST['checkout'], $_POST['szoba_tipus'], $_POST['kedvezmeny'], $_POST['payment_options'])) {
        $checkinDate = $_POST['checkin'];
        $checkoutDate = $_POST['checkout'];
        $selectedRoomTypeId = $_POST['szoba_tipus'];
        $selectedDiscountText = $_POST['kedvezmeny'];
        $paymentOption = $_POST['payment_options'];

        $sql_szoba = "SELECT szoba_id FROM szoba_tipusok WHERE nev = '$selectedRoomTypeId'";
        $result_szoba = DataBase::$conn->query($sql_szoba);
        
        if ($result_szoba && $result_szoba->num_rows > 0) {
            $row_szoba = $result_szoba->fetch_assoc();
            $szoba_id = $row_szoba['szoba_id'];

            $sql_kedvezmeny = "SELECT id FROM kedvezmenyek WHERE nev = '$selectedDiscountText'";
            $result_kedvezmeny = DataBase::$conn->query($sql_kedvezmeny);
            if ($result_kedvezmeny && $result_kedvezmeny->num_rows > 0) {
                $row_kedvezmeny = $result_kedvezmeny->fetch_assoc();
                $kedvezmeny_id = $row_kedvezmeny['id'];
            } else {
                echo "Nincs ilyen kedvezmény a rendszerben.";
            }

            $now = date('Y-m-d H:i:s');
            $sql_insert = "INSERT INTO foglalas (felhasznalo_id, check_in, check_out, mettol, meddig, szoba_id, fizetes_mod, fizetes_idopontja, kedvezmeny_id) 
                           VALUES ('$user_id', NULL, NULL, '$checkinDate', '$checkoutDate', '$szoba_id', '$paymentOption', NULL, '$kedvezmeny_id')";

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
