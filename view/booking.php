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

// Szoba tipusok lekérdezése
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

// Foglalás feldolgozása
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bookNow'])) {
    $checkin = date('Y-m-d', strtotime($_POST['checkin'])); // Formátum: 'YYYY-MM-DD'
    $checkout = date('Y-m-d', strtotime($_POST['checkout'])); // Formátum: 'YYYY-MM-DD'
    $szoba_id = $_POST['szoba_tipus']; // Ez csak egy példa, itt meg kell határoznod, hogy hogyan kapod meg a szoba azonosítóját
    $fizetes_mod = $_POST['payment_options']; // Ez csak egy példa, itt meg kell határoznod, hogy hogyan kapod meg a fizetési módot
    $kedvezmeny_id = $_POST['kedvezmeny']; // Ez csak egy példa, itt meg kell határoznod, hogy hogyan kapod meg a kedvezmény azonosítóját

    $sql = "INSERT INTO foglalas (felhasznalo_id, mettol, meddig, szoba_id, fizetes_mod, kedvezmeny_id)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = DataBase::$conn->prepare($sql);
$stmt->bind_param("ssssss", $user_id, $checkin, $checkout, $szoba_id, $fizetes_mod, $kedvezmeny_id);

    
    if ($stmt->execute()) {
        // Sikeres beszúrás esetén visszairányítás vagy más utasítások
        header("Location: index.php");
        exit();
    } else {
        echo "Hiba a foglalás feldolgozása során: " . $stmt->error;
    }
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
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date3" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" id="checkin" name="checkin" placeholder="Check In" data-target="#date3" data-toggle="datetimepicker" />
                                            <label for="checkin">Mettől</label>
                                        </div>
                                    </div>

                                    <script>
                                        $(function() {
                                            var currentDate = new Date();
                                            $('#date3').datetimepicker({
                                                format: 'YYYY-MM-DD',
                                                minDate: currentDate,
                                                useCurrent: false
                                            });
                                            $('#date4').datetimepicker({
                                                format: 'YYYY-MM-DD',
                                                minDate: currentDate,
                                                useCurrent: false
                                            });
                                        });
                                    </script>
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date4" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" id="checkout" name="checkout" placeholder="Check Out" data-target="#date4" data-toggle="datetimepicker" />
                                            <label for="checkout">Meddig</label>
                                        </div>
                                    </div>
                                    
                                    <?php
                                        // SQL lekérdezés a szoba_tipusok táblából
                                        $sql = "SELECT szobatipus_id, nev, ar FROM szoba_tipusok";
                                        $result = DataBase::$conn->query($sql);

                                        // Ellenőrizze, hogy a lekérdezés eredménye nem üres-e
                                        if ($result->num_rows > 0) {
                                            // Ha vannak eredmények, kezdjük a lenyíló lista létrehozását
                                            $select = '<select name="szoba_tipus" id="szoba_tipus">';
                                            $select .= '<option value="" disabled selected>Válasszon egy szoba típust</option>';

                                            // Az eredmények feldolgozása és a lenyíló lista kitöltése
                                            while ($row = $result->fetch_assoc()) {
                                                $nev = $row['nev'];
                                                $ar = $row['ar'];

                                                // Az option elemek hozzáadása a lenyíló listahez
                                                $select .= "<option value='{$row['szobatipus_id']}'>$nev ($ar Ft)</option>";
                                            }

                                            $select .= '</select>';

                                            echo $select;
                                        } else {
                                            // Ha nincsenek eredmények, kiírjuk a megfelelő üzenetet
                                            echo "<p>Nincsenek elérhető szoba típusok.</p>";
                                        }
                                        ?>
                                    </select>

                                    <?php
                                        // SQL lekérdezés a kedvezmenyek táblából
                                        $sql = "SELECT kedvezmeny_id, neve, szazalek FROM kedvezmenyek";
                                        $result = DataBase::$conn->query($sql);

                                        // Ellenőrizze, hogy a lekérdezés eredménye nem üres-e
                                        if ($result->num_rows > 0) {
                                            // Ha vannak eredmények, kezdjük a lenyíló lista létrehozását
                                            $select = '<select name="kedvezmeny" id="kedvezmeny">';
                                            $select .= '<option value="" disabled selected>Válasszon egy kedvezményt</option>';

                                            // Az eredmények feldolgozása és a lenyíló lista kitöltése
                                            while ($row = $result->fetch_assoc()) {
                                                $neve = $row['neve'];
                                                $szazalek = $row['szazalek'];

                                                // Az option elemek hozzáadása a lenyíló listahez
                                                $select .= "<option value='{$row['kedvezmeny_id']}'>$neve ($szazalek%)</option>";
                                            }

                                            $select .= '</select>';

                                            echo $select;
                                        } else {
                                            // Ha nincsenek eredmények, kiírjuk a megfelelő üzenetet
                                            echo "<p>Nincsenek elérhető kedvezmények.</p>";
                                        }
                                        ?>
     


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

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100 py-3" id="bookNowButton" name="bookNow">Foglalás</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- A mettől dátumnál ne lehessen korábbi a meddig dátum -->
        <script>
    $(document).ready(function() {
        $('#date4').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: moment().startOf('day') // Korábbi dátumok tiltása
        });
    });
</script>


<script>
    $(document).ready(function() {
        $("#bookNowButton").click(function() {
            // Előzően beszúrt üzenetek törlése
            $(".error-message").remove();

            var checkin = $("#checkin").val();
            var checkout = $("#checkout").val();
            var selectedRoomType = $("#szoba_tipus").val();
            var selectedDiscount = $("#kedvezmeny").val();

            if (checkin === '' || checkout === '') {
                $("<p class='error-message' style='color: red;'>Válasszon ki egy dátumot a 'Mettől' és 'Meddig' mezőben!</p>").insertAfter("#bookNowButton");
                return false; // Megakadályozza az űrlap elküldését
            }

            if (selectedRoomType === null && selectedDiscount === null) {
                $("<p class='error-message' style='color: red;'>Válasszon ki egy szobatípust és egy kedvezményt!</p>").insertAfter("#bookNowButton");
                return false; // Megakadályozza az űrlap elküldését
            } else if (selectedRoomType === null) {
                $("<p class='error-message' style='color: red;'>Válasszon ki egy szobatípust!</p>").insertAfter("#bookNowButton");
                return false; // Megakadályozza az űrlap elküldését
            } else if (selectedDiscount === null) {
                $("<p class='error-message' style='color: red;'>Válasszon ki egy kedvezményt!</p>").insertAfter("#bookNowButton");
                return false; // Megakadályozza az űrlap elküldését
            }
        });
    });
</script>


        <!-- Dátum helyes működéséhez -->
        <script>
            $(function() {
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

        <?php include('footer.php') ?>

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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
