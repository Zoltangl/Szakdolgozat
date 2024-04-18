<?php
session_start();
include('connection.php');

// Alapértelmezett érték a profil megjelenítéséhez
$profile_display = "<a href='signup.php' class='nav-item nav-link'>Registration/Login</a>";

// Ellenőrizzük a felhasználó bejelentkezési állapotát
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Bejelentkezett felhasználóknak megjelenítjük a "Profile" menüpontot
    $profile_display = '<div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Profile
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="edit_profile.php">Edit Profile</a></li>
                                <li><a id="logout_link" class="dropdown-item" href="logout.php">Log Out</a></li>
                            </ul>
                        </div>';
}

// Ellenőrizzük, hogy volt-e kijelentkezési kérés
if (isset($_GET['logout'])) {
    // Ha volt, csak állítsuk vissza a bejelentkezési változót false-ra
    $_SESSION['loggedin'] = false;
    // Átirányítás az index.php fájlra a kijelentkezés után
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <title>HappyHotel</title>
    <link rel="icon" href="img/logo.jpg" type="image/jpg">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Header Start -->
        <?php include 'header.php'; ?>
        <!-- Header End -->

        <!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Condition</title>
</head>
<body>
    <header>
        <h1>Üdvözöljük a HappyHotel weboldalán! Kérjük, olvassa el figyelmesen az alábbi felhasználási feltételeket, mielőtt használná weboldalunkat.</h1>
    </header>
    <main>
        <section id="terms">
        <h2>Általános információk</h2>
A HappyHotel weboldalának használata a felhasználók és a hotel közötti kapcsolat része. Az oldalon történő navigáció és szolgáltatásaink igénybevétele a jelen feltételek elfogadását jelenti.
A weboldal felhasználói kötelesek betartani az összes érvényes törvényt és rendeletet, amely vonatkozik a weboldal használatára, a szálloda szolgáltatásainak igénybevételére, valamint az itt közzétett információkra.
<h2>Felhasználói felelősség</h2>
<p>A felhasználók felelősséget vállalnak minden olyan tevékenységért, amelyet a HappyHotel weboldalán keresztül végeznek. Ez magában foglalja az összes regisztrációs adat valóságtartalmát és aktualitását.
A felhasználók kötelesek biztosítani, hogy a weboldalt nem használják jogellenes célokra vagy más felhasználók számítógépeinek károsítására.</p>
<h2>Szállásfoglalás és fizetés</h2>
<p>A szállásfoglalás és fizetés szabályai az egyes foglalásoknál eltérőek lehetnek. Kérjük, olvassa el az egyes ajánlatok részletes leírását és feltételeit.</p>
A fizetési módok elfogadásáról és a foglalások megerősítéséről további információkat kaphat ügyfélszolgálatunkon keresztül.
<h2>Lemondási politika</h2>
<p>A lemondási feltételek és díjak szintén változóak lehetnek. Kérjük, olvassa el a foglalásokhoz kapcsolódó részletes információkat a lemondási feltételekről.</p>
A lemondási politikáról további információkat kaphat ügyfélszolgálatunkon keresztül.
<h2>Adatvédelem</h2>
<p>A HappyHotel elkötelezett az Ön személyes adatainak védelme iránt. Adatvédelmi gyakorlatunkról bővebb információt talál az adatvédelmi irányelveinkben.</p>
<h2>Szerzői jogok</h2>
<p>Minden tartalom (szöveg, képek, grafikák stb.) a HappyHotel tulajdonát képezi. A tartalmakat nem szabad engedély nélkül másolni, reprodukálni vagy terjeszteni.</p>
<h2>Módosítások jogát fenntartjuk</h2>
<p>A HappyHotel fenntartja a jogot, hogy bármikor módosítsa vagy frissítse ezt a Felhasználási feltételeket. Kérjük, rendszeresen ellenőrizze az oldalt a legfrissebb információkért.
Kérjük, vegye figyelembe, hogy ezek a Felhasználási feltételek csak tájékoztató jellegűek, és nem helyettesítik a konkrét foglalásokra vonatkozó szerződéseket vagy megállapodásokat. Amennyiben kérdései merülnének fel, kérjük, lépjen kapcsolatba ügyfélszolgálatunkkal.</p>
        </section>
        
    </main>
    <footer>
        <p>© 2024 Minden jog fenntartva.</p>
    </footer>


        <!-- Footer Start -->
        <?php include('footer.php')?>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>