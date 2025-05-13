<?php
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Hasil Pencarian</title>
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
            font-size: 2.5em;
            font-weight: bold;
            color: #DEAA79;
            margin: 30px 0;
            text-align: center;
        }

        .vehicle-card {
            background-color: #5A2A00;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            color: white;
        }

        .vehicle-image {
            background-color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .vehicle-image img {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }

        .booking-btn {
            background-color: #FFE9C2;
            color: #5A2A00;
            border: none;
            padding: 8px 30px;
            border-radius: 20px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .booking-btn:hover {
            background-color: #DEAA79;
            transform: scale(1.05);
        }

        .alert {
            background-color: #FFE9C2;
            border: 1px solid #5A2A00;
            color: #5A2A00;
        }
    </style>
</head>

<body>
    <?php include "componen/navbar.php"; ?>

    <div class="container">
        <h1 class="page-title">Hasil Pencarian</h1>
        <div class="row">
            <?php
            if (isset($_GET['search'])) {
                $search = mysqli_real_escape_string($koneksi, $_GET['search']);
                $hasil = false;

                // Query untuk mencari di tabel mobil
                $query_mobil = mysqli_query($koneksi, "SELECT *, 'Mobil' as jenis FROM mobil 
                                                      WHERE merk LIKE '%$search%' OR 
                                                            harga LIKE '%$search%'");

                // Query untuk mencari di tabel motor
                $query_motor = mysqli_query($koneksi, "SELECT *, 'Motor' as jenis FROM motor 
                                                      WHERE merk LIKE '%$search%' OR 
                                                            harga LIKE '%$search%'");

                // Query untuk mencari di tabel sepeda
                $query_sepeda = mysqli_query($koneksi, "SELECT *, 'Sepeda' as jenis FROM sepeda 
                                                       WHERE merk LIKE '%$search%' OR 
                                                             harga LIKE '%$search%'");

                // Fungsi untuk menampilkan hasil
                function tampilkanHasil($query, $jenis)
                {
                    global $hasil;
                    if (mysqli_num_rows($query) > 0) {
                        $hasil = true;
                        while ($data = mysqli_fetch_array($query)) {
            ?>
                            <div class="col-md-4">
                                <div class="vehicle-card">
                                    <div class="vehicle-image">
                                        <img src="../img/<?php echo $data['gambar']; ?>" alt="<?php echo $data['merk']; ?>">
                                    </div>
                                    <div class="text-center">
                                        <h4><?php echo $data['merk']; ?></h4>
                                        <p>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?>/Hari</p>
                                        <p>Stok: <?php echo $data['jumlah']; ?></p>
                                        <a href="pesanan.php?jenis=<?php echo $data['jenis']; ?>&merk=<?php echo urlencode($data['merk']); ?>&harga=<?php echo $data['harga']; ?>&gambar=<?php echo urlencode($data['merk']); ?>.png"
                                            class="btn booking-btn">
                                            Booking
                                        </a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                }

                // Tampilkan semua hasil
                tampilkanHasil($query_mobil, 'Mobil');
                tampilkanHasil($query_motor, 'Motor');
                tampilkanHasil($query_sepeda, 'Sepeda');

                // Jika tidak ada hasil
                if (!$hasil) {
                    ?>
                    <div class="col-12">
                        <div class="alert" role="alert">
                            Tidak ada hasil yang ditemukan untuk pencarian "<?php echo htmlspecialchars($search); ?>"
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>