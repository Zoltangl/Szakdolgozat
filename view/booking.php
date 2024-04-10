<?php
session_start();
require('connection.php');
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['email'];
$user_id = $_SESSION['felhasznalo_id'];


$sql = "SELECT nev, ar FROM szoba_tipusok";
$result = DataBase::$conn->query($sql);
if ($result->num_rows > 0) {
    $szoba_tipusok = array();
    while ($row = $result->fetch_assoc()) {
        $szoba_tipusok[] = $row;
    }
} else {
    echo "Nincsenek adatok a szoba tipusok táblában.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HappyHotel</title>
    <link rel="icon" href="img/logo.jpg" type="image/jpg">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  



<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

<!-- Customized Bootstrap Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="css/style.css" rel="stylesheet">
<link href="css\confirm.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="css/modalPayContainer.css">

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

        <?php include 'header.php'; ?>
       
        <!-- Booking Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Szoba foglalás</h6>
                    <h1 class="mb-5">Foglalj le egy <span class="text-primary text-uppercase">Luxuszobát</span></h1>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6" id="szoba_kepek">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/csaladi.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="img/csoportroom.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="img/egyagyas.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/egyszemluxus.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <form>
                                <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="checkin" name="checkin" placeholder="Check In" data-target="#date3" data-toggle="datetimepicker" />

                                        <label for="checkin">Mettől</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date4" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="checkout" placeholder="Check Out" data-target="#date4" data-toggle="datetimepicker" />
                                        <label for="checkout">Meddig</label>
                                    </div>
                                </div>
                                    <select name="szoba_tipus" id="szoba_tipus">
                                        <?php
                                        if (!empty($szoba_tipusok)) {
                                            foreach ($szoba_tipusok as $szoba_tipus) {
                                                echo "<option value='{$szoba_tipus['nev']}'>{$szoba_tipus['nev']} - {$szoba_tipus['ar']} Ft</option>";
                                            }
                                        } else {
                                            echo "<option disabled selected>Nincs elérhető szoba típus</option>";
                                        }
                                        ?>
                                    </select>
                                        
                                    <select name="kedvezmeny" id="kedvezmeny">
                                        <?php
                                        $sql = "SELECT neve, szazalek FROM kedvezmenyek";
                                        $result = DataBase::$conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='{$row['neve']}'>{$row['neve']} - {$row['szazalek']}%</option>";
                                            }
                                        } else {
                                            echo "<option disabled selected>Nincs elérhető kedvezmény</option>";
                                        }
                                        ?>
                                    </select>
                                    <?php
                                        $sql = "SHOW COLUMNS FROM foglalas WHERE Field = 'fizetes_mod'";
                                        $result = DataBase::$conn->query($sql);

                                        if ($result) {
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                            
                                                preg_match_all("/'(.*?)'/", $row['Type'], $matches);
                                                $options = $matches[1];

                                                $options = array_filter($options);

                                                if (!empty($options)) {
                                                    echo '<select name="payment_options" id="payment_options">';
                                                    foreach ($options as $option) {
                                                        echo "<option value='$option'>$option</option>";
                                                    }
                                                    echo '</select>';
                                                    
                                                    echo '<button id="redirectButton" style="display:none;" class="btn btn-primary">Kártya adatainak megadása</button>';
                                                } else {
                                                    echo "Nincs fizetési opció az adatbázisban.";
                                                }
                                            } else {
                                                echo "Nincs fizetési opció az adatbázisban.";
                                            }
                                        } else {
                                            echo "Adatbázis hiba: " . DataBase::$conn->error; 
                                        }

                                        ?>

                                    <!-- Modális ablak -->
                                    <div id="modalPayContainer" class="modal">
                                      <div class="modal-content">
                                      <span id="closeModal" class="close">&times;</span> <!-- Bezáró gomb -->
                                        <h3>Bankkártyás fizetés</h3>
                                        <form id="paymentForm">
                                          <div class="form-group">
                                            <label for="cardNumber">Kártyaszám:</label>
                                            <input type="text" class="form-control" id="cardNumber" placeholder="xxxx-xxxx-xxxx-xxxx" maxlength="19" required>
                                          </div>
                                          <div class="form-group">
                                            <label for="cardOwner">Kártyatulajdonos neve:</label>
                                            <input type="text" class="form-control" id="cardOwner" placeholder="Atka Attila" required>
                                          </div>
                                          <div class="form-group">
                                            <label for="expiryDate">Lejárati dátum:</label>
                                            <input type="text" class="form-control" id="expiryDate" placeholder="HH/ÉÉ" maxlength="5" required>
                                          </div>
                                          <div class="form-group">
                                            <label for="securityCode">Biztonsági kód:</label>
                                            <input type="password" class="form-control" id="securityCode" placeholder="xxx" maxlength="3" required>
                                          </div>
                                          <button type="submit" class="btn btn-primary">Kártya adatainak mentése</button>
                                        </form>
                                      </div>
                                    </div>

                                    <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" id="bookNowButton" data-toggle="modal" data-target="#exampleModal">Foglalás</button>
                                    </div> 
                                    <!-- Modal -->
                                    <form method="post" action="">
                                    <div class="modal" id="exampleModal" tabindex="-1" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Foglalásom</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p id="bookingDetails"></p>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary" id="confirmBookingButton" name="confirm_booking">Megerősítés</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                        <script>

                                            document.getElementById("confirmBookingButton").addEventListener("click", function() {
                                            console.log("Form submission attempted");
                                            document.getElementById("exampleModal").querySelector("form").submit();
                                        });

                                            document.getElementById("bookNowButton").addEventListener("click", function(event) {
                                            event.preventDefault();
                                            var modal = document.getElementById("exampleModal");
                                            var selectRoomType = document.getElementById("szoba_tipus");
                                            var selectDiscount = document.getElementById("kedvezmeny");
                                            var modalBody = modal.querySelector('.modal-body');
                                            var selectedRoomTypeText = selectRoomType.options[selectRoomType.selectedIndex].text;
                                            var selectedDiscountText = selectDiscount.options[selectDiscount.selectedIndex].text;
                                            var userEmail = "<?php echo $user_email; ?>";
                                            var checkinDate = document.getElementById("checkin").value;
                                            var checkoutDate = document.getElementById("checkout").value;
                                            var selectedPaymentOption = document.getElementById("payment_options").value;
                                            if (checkinDate === "" || checkoutDate === "") {
                                                modalBody.innerHTML = "Kérjük, válasszon ki egy dátumot mind a 'Mettől', mind a 'Meddig' mezőben.";
                                                document.getElementById("confirmBookingButton").disabled = true;
                                            } else {
                                                var content = "Bejelentkezett felhasználó e-mail címe: " + userEmail  + "<br>" +
                                                              "Kiválasztott szoba típus: " + selectedRoomTypeText + "<br>" +
                                                              "Kiválasztott kedvezmény: " + selectedDiscountText + "<br>" +
                                                              "Választott fizetési mód: " + selectedPaymentOption + "<br>" +
                                                              "Ettől: " + checkinDate + "<br>" +
                                                              "Eddig: " + checkoutDate;
                                                modalBody.innerHTML = content;
                                            }
                                            modal.style.display = "block";
                                        
                                            // Az űrlap elküldése a "Megerősítés" gombra kattintáskor
                                            document.getElementById("confirmBookingButton").addEventListener("click", function() {
                                                document.getElementById("exampleModal").querySelector("form").submit();
                                            });
                                            });

                                        </script>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Dátum helyes működéséhez -->
<script>
$(function () {
    var currentDate = new Date();
    
    $('#date3').datetimepicker({
        minDate: currentDate,
        useCurrent: false
    });
    
    $('#date4').datetimepicker({
        minDate: currentDate,
        useCurrent: false
    });
});

</script>


        <!-- Booking End -->

        <?php include('footer.php')?>
        
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js\modal\modalPayContainer.js"></script>
    <script src="js\modal\bookingModal.js"></script>
   
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>