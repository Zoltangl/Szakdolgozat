<?php
session_start();
require('connection.php');

if(isset($_POST['foglalas_id'])) {
    $foglalas_id = $_POST['foglalas_id'];


    $sql = "DELETE FROM foglalas WHERE foglalas_id = ?";
    $stmt = DataBase::$conn->prepare($sql);
    $stmt->bind_param("i", $foglalas_id);
    if($stmt->execute()) {
        echo "A foglalás sikeresen törölve lett.";
    } else {
        echo "Hiba történt a foglalás törlése során.";
    }
} else {
    echo "Érvénytelen kérés.";
}
?>
