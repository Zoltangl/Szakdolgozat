<?php
session_start();
require('connection.php');

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Felhasználó azonosítójának lekérdezése a bejelentkezési munkamenetből
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $sql = "SELECT felhasznalo_id FROM felhasznalo WHERE email_cim = ?";
    $stmt = DataBase::$conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['felhasznalo_id'];
    } else {
        exit("Nem sikerült megszerezni a felhasználó ID-ját.");
    }
} else {
    exit("Nem sikerült megszerezni a felhasználó email címét.");
}

// Felhasználó foglalásainak lekérdezése
$sql = "SELECT foglalas_id, check_in, check_out, mettol, meddig, szoba_id, fizetes_mod, fizetes_idopontja, kedvezmeny_id 
        FROM foglalas 
        WHERE felhasznalo_id = ?";
$stmt = DataBase::$conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <title>HappyHotel</title>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" href="img/logo.jpg" type="image/jpg">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/register.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <?php include('header.php');?>


        <?php 
        if ($result->num_rows > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Mettől</th>';
            echo '<th scope="col">Meddig</th>';
            echo '<th scope="col">Szobaszám</th>';
            echo '<th scope="col">Fizetés módja</th>';
            echo '<th scope="col">Kedvezmény neve</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while($row = $result->fetch_assoc()) {
                $kedvezmeny_id = $row["kedvezmeny_id"];
                $kedvezmeny_nev = "";

                if($kedvezmeny_id !== null) {
                    $kedvezmeny_sql = "SELECT neve FROM kedvezmenyek WHERE kedvezmeny_id = ?";
                    $stmt = DataBase::$conn->prepare($kedvezmeny_sql);
                    $stmt->bind_param("i", $kedvezmeny_id);
                    $stmt->execute();
                    $kedvezmeny_result = $stmt->get_result();

                    if($kedvezmeny_result->num_rows > 0) {
                        $kedvezmeny_row = $kedvezmeny_result->fetch_assoc();
                        $kedvezmeny_nev = $kedvezmeny_row['neve'];
                    }
                }

                echo '<tr>';
                echo '<td>' . $row["mettol"] . '</td>';
                echo '<td>' . $row["meddig"] . '</td>';
                echo '<td>' . $row["szoba_id"] . '</td>';
                echo '<td>' . $row["fizetes_mod"] . '</td>';
                echo '<td>' . $kedvezmeny_nev . '</td>'; // Kedvezmény neve
                echo '<td>';
                echo '<form id="deleteBookingForm" data-foglalas-id="' . $row["foglalas_id"] . '">';
                echo '<button type="button" class="btn btn-danger deleteBookingBtn rounded-pill">Foglalás törlése</button>';
                echo '</form>';

                
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-info" role="alert">Nincsenek foglalások a felhasználó számára.</div>';
        }
        ?>
     

</body>

</html>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Custom JavaScript -->
<script>
$(document).ready(function(){
    $('.deleteBookingBtn').click(function(){
        var foglalas_id = $(this).closest('form').data('foglalas-id');
        var confirmation = confirm("Biztosan törölni szeretné ezt a foglalást?");

        if(confirmation) {
            $.ajax({
                type: "POST",
                url: "delete_booking.php",
                data: { foglalas_id: foglalas_id },
                success: function(response){
                    alert(response);
                    location.reload();
                }
            });
        }
    });
});
</script>
<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>
