<?php
include "../koneksi.php";

// Ambil parameter dari URL
$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';
$merk = isset($_GET['merk']) ? $_GET['merk'] : '';
$harga = isset($_GET['harga']) ? $_GET['harga'] : '';

if (isset($_POST['pesan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $no_hp = $_POST['no_hp'];

    // Bersihkan nomor HP dari karakter non-angka
    $no_hp_clean = preg_replace("/[^0-9]/", "", $no_hp);

    // Validasi nomor HP
    if (strlen($no_hp_clean) < 10 || strlen($no_hp_clean) > 13) {
        echo "<script>
                alert('Nomor HP harus 10-13 digit!');
                history.back();
            </script>";
        exit;
    }

    // Validasi format nomor HP Indonesia
    if (!preg_match("/^(08|628)[0-9]{8,11}$/", $no_hp_clean)) {
        echo "<script>
                alert('Format nomor HP tidak valid! Gunakan format 08xx atau 628xx');
                history.back();
            </script>";
        exit;
    }

    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $merk = $_POST['merk'];
    $tgl_sewa = $_POST['tanggal_sewa'];
    $lama_disewa = $_POST['lama_sewa'];

    // Gunakan nomor HP yang sudah dibersihkan
    $no_hp = $no_hp_clean;

    // Hitung total harga
    $total_harga = $harga * $lama_disewa;

    // Cek stok kendaraan
    $query_stok = mysqli_query($koneksi, "SELECT jumlah FROM $jenis_kendaraan WHERE merk='$merk'");
    $data_stok = mysqli_fetch_array($query_stok);

    if ($data_stok && $data_stok['jumlah'] > 0) {
        // Mulai transaction
        mysqli_begin_transaction($koneksi);

        try {
            // Insert ke tabel pesan
            $sql_pesan = "INSERT INTO pesan (nama, no_hp, jenis_kendaraan, merk, tgl_sewa, lama_disewa, harga) 
                VALUES ('$nama', '$no_hp', '$jenis_kendaraan', '$merk', '$tgl_sewa', '$lama_disewa', '$total_harga')";

            // Update stok
            $sql_update = "UPDATE $jenis_kendaraan SET jumlah = jumlah - 1 WHERE merk='$merk'";

            // Jalankan query
            mysqli_query($koneksi, $sql_pesan);
            mysqli_query($koneksi, $sql_update);

            // Commit transaction
            mysqli_commit($koneksi);

            echo "<script>
                    alert('Pesanan berhasil dibuat!');
                    window.location='keranjang.php';
                </script>";
        } catch (Exception $e) {
            // Rollback jika terjadi error
            mysqli_rollback($koneksi);
            echo "<script>
                    alert('Gagal membuat pesanan!');
                    history.back();
                </script>";
        }
    } else {
        echo "<script>
                alert('Maaf, stok kendaraan tidak tersedia');
                history.back();
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Form Pesanan</title>
    <style>
        body {
            background-color: #FFF5E0;
        }

        .container {
            padding: 20px;
            margin-top: 50px;
        }

        .row {
            min-height: 600px;
            /* Mengatur tinggi minimum row */
        }

        .vehicle-image {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            height: 100%;
            /* Mengisi tinggi penuh */
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .vehicle-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .order-container {
            background-color: #5A2A00;
            border-radius: 15px;
            padding: 30px;
            height: 100%;
            /* Mengisi tinggi penuh */
            color: white;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 20px;
            padding: 10px 15px;
        }

        .btn-pesan {
            background-color: #FFE9C2;
            color: #5A2A00;
            border: none;
            padding: 10px 30px;
            border-radius: 20px;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
        }

        .btn-pesan:hover {
            background-color: #DEAA79;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .vehicle-image {
                margin-bottom: 20px;
                height: 400px;
                /* Tinggi tetap untuk mobile */
            }

            .order-container {
                height: auto;
            }
        }
    </style>
</head>

<body>
    <?php include "componen/navbar.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="vehicle-image">
                    <?php
                    $jenis_kendaraan = $_GET['jenis']; // Motor, Mobil, atau Sepeda
                    $query = mysqli_query($koneksi, "SELECT gambar FROM $jenis_kendaraan WHERE merk='$merk'");
                    $data = mysqli_fetch_array($query);
                    $gambar = $data['gambar'];
                    ?>
                    <img src="../img/<?php echo $gambar; ?>" alt="<?php echo $merk; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="order-container">
                    <h2 class="text-center mb-4">PESAN</h2>
                    <form action="" method="POST" onsubmit="return validateForm()">
                        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                        <input type="tel" class="form-control" name="no_hp"
                            placeholder="No HP (Contoh: 08xx atau 628xx)"
                            id="no_hp"
                            required>

                        <input type="text" class="form-control" name="jenis_kendaraan" value="<?php echo $jenis; ?>" readonly>
                        <input type="text" class="form-control" name="merk" value="<?php echo $merk; ?>" readonly>

                        <input type="date" class="form-control" name="tanggal_sewa" required>
                        <input type="number" class="form-control" name="lama_sewa"
                            placeholder="Lama Sewa (Hari)"
                            min="1"
                            required
                            onchange="hitungTotal(this.value)">

                        <input type="text" class="form-control" id="preview_total" readonly>

                        <button type="submit" name="pesan" class="btn btn-pesan">Pesan Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function hitungTotal(lamaSewa) {
            let harga = <?php echo $harga; ?>;
            let total = harga * lamaSewa;
            document.getElementById('preview_total').value = 'Rp ' + total.toLocaleString('id-ID');
        }

        function validateForm() {
            var noHP = document.getElementById('no_hp').value;
            // Bersihkan nomor dari karakter non-angka
            noHP = noHP.replace(/\D/g, '');

            // Validasi panjang
            if (noHP.length < 10 || noHP.length > 13) {
                alert('Nomor HP harus 10-13 digit!');
                return false;
            }

            // Validasi format
            if (!noHP.match(/^(08|628)/)) {
                alert('Nomor HP harus dimulai dengan 08 atau 628!');
                return false;
            }

            return true;
        }

        // Fungsi untuk format nomor HP saat diketik
        document.getElementById('no_hp').addEventListener('input', function(e) {
            // Hanya izinkan angka
            this.value = this.value.replace(/\D/g, '');

            // Batasi panjang input
            if (this.value.length > 13) {
                this.value = this.value.slice(0, 13);
            }
        });
    </script>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>