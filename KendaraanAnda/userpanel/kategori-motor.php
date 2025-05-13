<?php
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Kategori Motor</title>
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../img/gambar3.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .page-title {
            font-size: 3.5em;
            font-weight: bold;
            color: #DEAA79;
            text-align: center;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            margin: 0;
        }

        .col-md-4 {
            padding: 0;
            flex: 0 0 auto;
            width: auto;
        }

        .car-card {
            background-color: #DEAA79;
            border-radius: 15px;
            padding: 15px;
            width: 400px;
            height: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 0;
            transition: all 0.5s;

        }

        .car-card:hover {
            background-color: #D8A16E;
            transform: scale(1.05);
            transform: translateY(-2px);
        }

        .car-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .car-image img {
            width: 200px;
            height: 120px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .car-card:hover .car-image img {
            transform: scale(1.05);

        }

        .car-info {
            text-align: center;
            color: #5A2A00;
            padding: 0 5px;
        }

        .car-info h4 {
            font-size: 1.1em;
            margin-bottom: 8px;
        }

        .car-info p {
            font-size: 0.9em;
            margin-bottom: 5px;
        }

        .booking-btn {
            background-color: #5A2A00;
            color: #fff;
            border: none;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            transition: all 0.3s;

        }

        .booking-btn:hover {
            background-color: #DEAA79;
            color: #5A2A00;
            transform: translateY(-2px);

        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .car-card {
                width: 220px;
            }

            .car-image {
                width: 190px;
                height: 120px;
            }

            .car-image img {
                width: 170px;
                height: 100px;
            }
        }

        .vehicle-image {
            background-color: white;
            width: 100%;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
        }

        .vehicle-image img {
            max-width: 200px !important;
            max-height: 160px !important;
            width: auto !important;
            height: auto !important;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <?php include "componen/navbar.php"; ?>

    <div class="container mt-5">
        <h1 class="page-title">Kategori Motor</h1>
        <div class="row">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM motor");

            while ($data = mysqli_fetch_array($query)) {
            ?>
                <div class="col-md-4">
                    <div class="car-card">
                        <div class="vehicle-image">
                            <img src="../img/<?php echo $data['gambar']; ?>" alt="<?php echo $data['merk']; ?>">
                        </div>
                        <div class="text-center">
                            <h4><?php echo $data['merk']; ?></h4>
                            <p>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?>/Hari</p>
                            <p>Stok: <?php echo $data['jumlah']; ?></p>
                            <a href="pesanan.php?jenis=Motor&merk=<?php echo urlencode($data['merk']); ?>&harga=<?php echo $data['harga']; ?>&gambar=<?php echo urlencode($data['merk']); ?>.png"
                                class="btn booking-btn">
                                Booking
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

<?php include "componen/footer.php"; ?>

</html>