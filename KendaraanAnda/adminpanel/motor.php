<?php
include "session.php";
include "../koneksi.php";

$querymotor = mysqli_query($koneksi, "SELECT * FROM motor");
$jumlahmotor = mysqli_num_rows($querymotor);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Motor</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        .navbar-brand {
            font-weight: bold;
        }

        .nav-link {
            color: black;
        }

        .table {
            margin-top: 20px;
        }

        .btn-simpan {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 20px;
        }
    </style>
</head>

<body>
    <?php include "componen/navbar.php"; ?>

    <div class="container mt-4">
        <div class="d-flex align-items-center mb-3">
            <li class="breadcrumb-item"> <a href="../adminpanel" class="text-decoration-none text-dark">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <span class="mx-2">/</span>
            <span>
                <li class="fas fa-motorcycle"></li> Motor
            </span>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-4">Tambah Motor</h5>
                <form action="" method="POST" class="d-flex gap-3" enctype="multipart/form-data">
                    <input type="text" class="form-control" name="merk" placeholder="input merk" required>
                    <input type="number" class="form-control" name="harga" placeholder="input harga" required>
                    <input type="number" class="form-control" name="jumlah" placeholder="input jumlah" required>
                    <input type="file" class="form-control" name="gambar" accept="image/*" required>
                    <button type="submit" class="btn btn-simpan" name="simpan">Simpan</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Motor</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Merk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../koneksi.php";
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM motor");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['merk']; ?></td>
                                <td><?php echo $data['harga']; ?></td>
                                <td><?php echo $data['jumlah']; ?></td>
                                <td>
                                    <img src="../img/<?php echo $data['gambar']; ?>"
                                        alt="<?php echo $data['merk']; ?>"
                                        style="width: 50px; height: 50px; object-fit: contain;">
                                </td>
                                <td>
                                    <a href="motor-detail.php?p=<?php echo $data['id']; ?>"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-search"></i>
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
    </div>

    <?php
    if (isset($_POST['simpan'])) {
        $merk = htmlspecialchars($_POST['merk']);
        $harga = htmlspecialchars($_POST['harga']);
        $jumlah = htmlspecialchars($_POST['jumlah']);

        // Upload gambar
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $tipe = $_FILES['gambar']['type'];
        $size = $_FILES['gambar']['size'];

        // Cek tipe file
        $allowed = array('image/jpeg', 'image/png', 'image/jpg');
        if (!in_array($tipe, $allowed)) {
            echo "<script>
                    alert('Format file tidak didukung!');
                  </script>";
            exit;
        }

        // Cek ukuran file (maksimal 2MB)
        if ($size > 2000000) {
            echo "<script>
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                  </script>";
            exit;
        }

        // Generate nama file unik
        $nama_file = time() . '-' . $gambar;

        // Upload file
        if (move_uploaded_file($tmp, "../img/" . $nama_file)) {
            $query = mysqli_query($koneksi, "INSERT INTO motor (merk, harga, jumlah, gambar) 
                                           VALUES ('$merk', '$harga', '$jumlah', '$nama_file')");

            if ($query) {
                echo "<script>
                        alert('Data berhasil ditambahkan!');
                        window.location='motor.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "');
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Gagal mengupload gambar!');
                  </script>";
        }
    }
    ?>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>