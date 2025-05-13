<?php
session_start();
include "../koneksi.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>KendaraanAnda</title>
</head>

<style>
    body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../img/gambar1.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .welcome-text {
        color: #DEAA79;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        font-size: 3em;
        font-weight: bold;
        margin-top: 100px;
    }

    .sub-text {
        color: #DEAA79;
        font-size: 1.2em;
        margin-top: 20px;
        opacity: 0.9;
    }

    .content-wrapper {
        text-align: center;
        padding: 50px 20px;
    }

    .slider-container {
        padding: 20px 0;
    }

    .owl-carousel .item {
        margin: 10px;
        background: rgba(255, 255, 255, 0.9);
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        transition: transform 0.3s;
    }

    .owl-carousel .item:hover {
        transform: translateY(-5px);
    }

    .owl-carousel .item img {
        width: 300px;
        height: 200px;
        object-fit: contain;
        margin: 0 auto;
    }

    .car-info {
        color: #333;
        padding: 10px 0;
    }

    .car-info h5 {
        margin: 0;
        font-weight: bold;
        font-size: 1.2em;
    }
</style>

<header>
    <?php include "componen/navbar.php"; ?>
</header>

<body>
    <div class="container">
        <div class="content-wrapper">
            <h1 class="welcome-text">Selamat Datang di KendaraanAnda</h1>
            <p class="sub-text">Solusi Terbaik untuk Kebutuhan Kendaraan Anda</p>

            <div class="slider-container mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <img src="../img/mitsubishi.png" alt="Mobil" class="img-fluid">
                                <div class="car-info mt-2">
                                    <h5>Mitsubishi</h5>
                                </div>
                            </div>
                            <div class="item">
                                <img src="../img/motor1.png" alt="Motor" class="img-fluid">
                                <div class="car-info mt-2">
                                    <h5>Beat</h5>
                                </div>
                            </div>
                            <div class="item">
                                <img src="../img/sepeda1.png" alt="Sepeda" class="img-fluid">
                                <div class="car-info mt-2">
                                    <h5>Polygon</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        });
    </script>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

<?php include "componen/footer-khusus.php"; ?>


</html>