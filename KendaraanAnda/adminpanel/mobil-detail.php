<?php
include "../koneksi.php";

$id = isset($_GET['p']) ? $_GET['p'] : '';

if (empty($id)) {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location='mobil.php';
          </script>";
    exit;
}

$query = mysqli_query($koneksi, "SELECT * FROM mobil WHERE id='$id'");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "<script>
            alert('Data mobil tidak ditemukan!');
            
            window.location='mobil.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mobil</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <style>
        .main {
            height: 100vh;
        }

        .detail-col {
            background-color: #fff;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-light">
    <?php include "componen/navbar.php"; ?>

    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 detail-col p-5">
                    <h2 class="text-center mb-4">Edit Mobil</h2>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="merk" class="form-label">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk"
                                value="<?php echo $data['merk']; ?>" autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga"
                                value="<?php echo $data['harga']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah"
                                value="<?php echo $data['jumlah']; ?>">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                            <button type="submit" class="btn btn-danger" name="hapusBtn"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                Hapus
                            </button>
                            <a href="mobil.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['editBtn'])) {
        $merk = htmlspecialchars($_POST['merk']);
        $harga = htmlspecialchars($_POST['harga']);
        $jumlah = htmlspecialchars($_POST['jumlah']);

        $query = mysqli_query($koneksi, "UPDATE mobil SET 
                                       merk='$merk', 
                                       harga='$harga', 
                                       jumlah='$jumlah' 
                                       WHERE id='$id'");

        if ($query) {
            echo "<script>
                    alert('Data berhasil diupdate!');
                    window.location='mobil.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal mengupdate data: " . mysqli_error($koneksi) . "');
                  </script>";
        }
    }

    if (isset($_POST['hapusBtn'])) {
        // Hapus file gambar jika ada
        if ($data['gambar'] && file_exists("../img/" . $data['gambar'])) {
            unlink("../img/" . $data['gambar']);
        }

        // Hapus data dari database
        $query = mysqli_query($koneksi, "DELETE FROM mobil WHERE id='$id'");

        if ($query) {
            echo "<script>
                    alert('Data berhasil dihapus!');
                    window.location='mobil.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
                  </script>";
        }
    }
    ?>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>