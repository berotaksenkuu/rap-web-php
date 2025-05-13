<?php
include "../koneksi.php";

$query = mysqli_query($koneksi, "SELECT p.*, 
    CASE 
        WHEN p.jenis_kendaraan = 'Mobil' THEN (SELECT gambar FROM mobil WHERE merk = p.merk)
        WHEN p.jenis_kendaraan = 'Motor' THEN (SELECT gambar FROM motor WHERE merk = p.merk)
        WHEN p.jenis_kendaraan = 'Sepeda' THEN (SELECT gambar FROM sepeda WHERE merk = p.merk)
    END as gambar_kendaraan,
    CASE 
        WHEN p.jenis_kendaraan = 'Mobil' THEN (SELECT harga FROM mobil WHERE merk = p.merk)
        WHEN p.jenis_kendaraan = 'Motor' THEN (SELECT harga FROM motor WHERE merk = p.merk)
        WHEN p.jenis_kendaraan = 'Sepeda' THEN (SELECT harga FROM sepeda WHERE merk = p.merk)
    END as harga_kendaraan
    FROM pesan p");

if (!$query) {
    die("Error dalam query: " . mysqli_error($koneksi));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Keranjang</title>
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../img/gambar2.jpg');
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
            color: #FFE9C2;
            text-align: center;
            margin: 40px 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            background-color: #FFE9C2;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .cart-item:hover {
            transform: translateY(-5px);
        }

        .vehicle-image-container {
            width: 100%;
            padding: 0 15px;
        }

        .vehicle-image {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            aspect-ratio: 1/1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px 0;
        }

        .vehicle-image img {
            max-width: 150%;
            max-height: 150%;
            object-fit: contain;
        }

        .info-box {
            background-color: #5A2A00;
            color: white;
            padding: 8px 15px;
            border-radius: 10px;
            text-align: center;
            width: 100%;
        }

        .merk-box {
            background-color: white;
            color: #000;
            padding: 8px 20px;
            border-radius: 10px;
            margin-bottom: 10px;
            text-align: center;
            width: 100%;
        }

        .return-date {
            background-color: #5A2A00;
            color: white;
            padding: 8px 15px;
            border-radius: 10px;
            text-align: center;
            width: 100%;
        }

        .col-md-4 {
            padding-right: 20px;
        }

        @media (max-width: 768px) {
            .vehicle-image-container {
                padding: 0;
                margin-bottom: 20px;
            }

            .col-md-4 {
                padding-right: 15px;
                padding-left: 15px;
            }
        }
    </style>
</head>

<body>
    <?php include "componen/navbar.php"; ?>

    <div class="container">
        <h1 class="page-title">KERANJANG</h1>
        <div class="row">
            <?php while ($data = mysqli_fetch_array($query)) {
                // Hitung tanggal pengembalian
                $tgl_sewa = new DateTime($data['tgl_sewa']);
                $lama_sewa = $data['lama_disewa'];
                $tgl_kembali = clone $tgl_sewa;
                $tgl_kembali->modify("+$lama_sewa days");
            ?>
                <div class="col-md-6">
                    <div class="cart-item">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="vehicle-image-container">
                                    <div class="vehicle-image">
                                        <img src="../img/<?php echo $data['gambar_kendaraan']; ?>"
                                            alt="<?php echo $data['merk']; ?>"
                                            onerror="this.src='../img/default.png'">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="info-box">
                                            <?php echo $data['jenis_kendaraan']; ?>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="info-box">
                                            <?php echo $data['merk']; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="info-box">
                                            <?php
                                            // Hitung total harga (harga kendaraan * lama sewa)
                                            $total_harga = $data['harga_kendaraan'] * $data['lama_disewa'];
                                            echo "Rp " . number_format($total_harga, 0, ',', '.');
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="return-date">
                                            Tanggal Kembali: <?php echo $tgl_kembali->format('d-m-Y'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>