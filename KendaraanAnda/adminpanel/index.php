<?php
include "session.php";
include "../koneksi.php";

$querymobil = mysqli_query($koneksi, "SELECT * FROM mobil");
$jumlahmobil = mysqli_num_rows($querymobil);
$querymotor = mysqli_query($koneksi, "SELECT * FROM motor");
$jumlahmotor = mysqli_num_rows($querymotor);
$querysepeda = mysqli_query($koneksi, "SELECT * FROM sepeda");
$jumlahsepeda = mysqli_num_rows($querysepeda);
$querypesan = mysqli_query($koneksi, "SELECT * FROM pesan");
$jumlahpesan = mysqli_num_rows($querypesan);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>HOME</title>
</head>

<style>
    .kotak {
        border: solid;
    }

    .summary-mobil {
        background-color: #FFD992;
        border-radius: 15px;
    }

    .summary-motor {
        background-color: #C1F5A5;
        border-radius: 15px;
    }

    .summary-sepeda {
        background-color: #FAC5A8;
        border-radius: 15px;
    }

    .summary-pesan {
        background-color: #E6C5FF;
        border-radius: 15px;
    }

    .no-decoration {
        text-decoration: none;
        color: black;
    }

    .no-decoration:hover {
        color: white;
    }
</style>
<header>
    <?php
    include "componen/navbar.php";
    ?>
</header>

<body>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home"></i> Home
                </li>
            </ol>
        </nav>
        <h2>Hello <?php echo $_SESSION['username']; ?></h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class=" summary-mobil p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-car fa-7x p-3 text-black-50"></i>
                            </div>
                            <div class="col-6">
                                <h3 class="fs-2">Mobil</h3>
                                <p class="fs-4"><?php echo $jumlahmobil; ?> Merk</p>
                                <p><a href="mobil.php" class="no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class=" summary-motor p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-motorcycle fa-7x p-3 text-black-50"></i>
                            </div>
                            <div class="col-6">
                                <h3 class="fs-2">Motor</h3>
                                <p class="fs-4"><?php echo $jumlahmotor; ?> Merk</p>
                                <p><a href="motor.php" class="no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class=" summary-sepeda p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-bicycle fa-7x p-3 text-black-50"></i>
                            </div>
                            <div class="col-6">
                                <h3 class="fs-2">sepeda</h3>
                                <p class="fs-4"><?php echo $jumlahsepeda; ?> Merk</p>
                                <p><a href="sepeda.php" class="no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class=" summary-pesan p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-cart-shopping fa-7x p-3 text-black-50"></i>
                            </div>
                            <div class="col-6">
                                <h3 class="fs-2">Pesanan</h3>
                                <p class="fs-4"><?php echo $jumlahpesan; ?> Pesanan</p>
                                <p><a href="pesan.php" class="no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>