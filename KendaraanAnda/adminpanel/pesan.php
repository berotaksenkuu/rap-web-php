<?php
include "session.php";
include "../koneksi.php";

// Fungsi hapus dengan pengembalian stok
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Ambil informasi pesanan sebelum dihapus
    $query_info = mysqli_query($koneksi, "SELECT jenis_kendaraan, merk FROM pesan WHERE id = '$id'");
    $data_info = mysqli_fetch_array($query_info);

    if ($data_info) {
        // Mulai transaction
        mysqli_begin_transaction($koneksi);

        try {
            // Kembalikan stok ke tabel kendaraan yang sesuai
            $jenis_tabel = strtolower($data_info['jenis_kendaraan']); // konversi ke lowercase
            $merk = $data_info['merk'];

            // Update stok
            $update_stok = mysqli_query(
                $koneksi,
                "UPDATE $jenis_tabel SET jumlah = jumlah + 1 WHERE merk = '$merk'"
            );

            // Hapus pesanan
            $hapus = mysqli_query($koneksi, "DELETE FROM pesan WHERE id = '$id'");

            if ($update_stok && $hapus) {
                mysqli_commit($koneksi);
                echo "<script>
                        alert('Pesanan berhasil dihapus dan stok dikembalikan!');
                        window.location='pesan.php';
                      </script>";
            } else {
                throw new Exception(mysqli_error($koneksi));
            }
        } catch (Exception $e) {
            mysqli_rollback($koneksi);
            echo "<script>
                    alert('Gagal menghapus pesanan: " . $e->getMessage() . "');
                    window.location='pesan.php';
                  </script>";
        }
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
    <title>Daftar Pesanan</title>
</head>

<style>
    .no-decoration {
        text-decoration: none;
    }
</style>

<header>
    <?php include "componen/navbar.php"; ?>
</header>

<body>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-cart-shopping"></i> Pesanan
                </li>
            </ol>
        </nav>
        <h2>Daftar Pesanan</h2>
        <div class="table-responsive mt-3">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Jenis Kendaraan</th>
                        <th>Merk</th>
                        <th>Tanggal Sewa</th>
                        <th>Lama Sewa</th>
                        <th>Total Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $number = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM pesan ORDER BY tgl_sewa DESC");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $number++; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['no_hp']; ?></td>
                            <td><?php echo $data['jenis_kendaraan']; ?></td>
                            <td><?php echo $data['merk']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($data['tgl_sewa'])); ?></td>
                            <td><?php echo $data['lama_disewa']; ?> Hari</td>
                            <td>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="javascript:void(0);"
                                    onclick="confirmDelete(<?php echo $data['id']; ?>)"
                                    class="btn btn-danger">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pesanan ini? Stok kendaraan akan dikembalikan.')) {
                window.location.href = 'pesan.php?hapus=' + id;
            }
        }
    </script>
</body>

</html>