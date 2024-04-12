<?php
session_start();
include('connection.php');



?>



<!DOCTYPE html>
<html lang="en">

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
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <?php include 'header.php'; ?>

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/fejlec2.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">KEZDŐLAP</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Kezdőlap</a></li>
                            
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


     

        
        
        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h6 class="section-title text-start text-primary text-uppercase">Kezdőlap</h6>
                        <h1 class="mb-4">Üdvözöljük a <span class="text-primary text-uppercase">HappyHotelben</span></h1>
                        <p class="mb-4">
                            Üdvözöljük a HappyHotel kezdőlapján! Büszkén mutatjuk be luxus szolgáltatásainkat, melyekkel vendégeinknek emlékezetes élményt nyújtunk. HappyHotel egyedi hangulatával és kifinomult kényelmével tökéletes választás mindazok számára, akik kikapcsolódásra és pihenésre vágynak. Legyen szó üzleti útról, romantikus hétvégéről vagy családi nyaralásról, szállodánk kivételes szolgáltatásokkal és barátságos kiszolgálással várja Önt. A kifinomult design és a legmagasabb színvonalú kényelem mellett a helyi kultúra és gasztronómia is kiemelt figyelmet kap nálunk. Fedezze fel városunkat kényelmes és stílusos szállodánkból, és hagyja, hogy élményeink örökre a memóriájában maradjanak!</p>
                        
                        <a class="btn btn-primary py-3 px-5 mt-2" href="about.php">Explore More</a>
                    </div>
                    <div class="col-lg-6">
    <div class="row g-2">
        <div class="col-6">
            <div class="d-flex justify-content-start align-items-center h-100">
                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/aboutbar.jpg">
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex justify-content-start align-items-center h-100">
                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s" src="img/aboutmedence.jpg">
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex justify-content-start align-items-center h-100">
                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/aboutswimmingpool.jpg">
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex justify-content-start align-items-center h-100">
                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/abouthotel.jpg">
            </div>
        </div>
    </div>
</div>
</div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Room Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Szobáink</h6>
                    <h1 class="mb-5">Fedezze fel <span class="text-primary text-uppercase">Szobáinkat</span></h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/csaladi.jpg" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">21.000 Ft/Éjszaka</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Családi szoba</h5>
                                    <div class="ps-2">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3"><i class="fa fa-ágy text-primary me-2"></i>3 ágy</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-zuhanyzó text-primary me-2"></i>2 zuhanyzó</small>
                                    <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                </div>
                                <p class="text-body mb-3">Fedezze fel kényelmes és praktikus családi szobáinkat! Ideális választás családok számára, akik együtt szeretnék élvezni a kényelmet és a kikapcsolódást. A családi szoba tágas teret kínál a szülőknek és a gyerekeknek egyaránt.</p>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-primary rounded py-2 px-4" href="roomdetails/csaladi.php">Megtekintés</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/lakosztaly.jpg" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">52.000 Ft/éjszaka</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Lakosztály</h5>
                                    <div class="ps-2">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3"><i class="fa fa-ágy text-primary me-2"></i>1 ágy</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-zuhanyzó text-primary me-2"></i>1 zuhanyzó</small>
                                    <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                </div>
                                <p class="text-body mb-3">Fedezze fel luxus és kényelem csúcsát a hotel lakosztályában! Ez a kifinomult és tágas szállásegység tökéletes választás azoknak, akik különleges élményre vágynak. A lakosztály kényelmes hálószobát, tágas nappalit és exkluzív fürdőszobát kínál, amely minden igényt kielégít.</p>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-primary rounded py-2 px-4" href="roomdetails/lakosztaly.php">Megtekintés</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/fapados.jpg" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">6.500 Ft/éjszaka</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Fapados szoba</h5>
                                    <div class="ps-2">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3"><i class="fa fa-ágy text-primary me-2"></i>1 ágy</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-zuhanyzó text-primary me-2"></i>1 zuhanyzó</small>
                                    <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                </div>
                                <p class="text-body mb-3">Fedezze fel a kényelmes és megfizethető fapados hotelszobát! Ez a praktikus szállásegység ideális választás azoknak, akik egy egyszerű és kényelmes tartózkodást keresnek megfizethető áron.</p>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-primary rounded py-2 px-4" href="roomdetails/fapados.php">Megtekintés</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="room.php">Explore More</a>
            </div>
        </div>
        <!-- Room End -->
        

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