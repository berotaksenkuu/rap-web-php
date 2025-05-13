<style>
    .nav-link:hover {
        color: #ffffff !important;
        background-color: #5A2A00;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .brand-text {
        font-size: 24px;
        font-weight: bold;
    }

    .brand-colored {
        color: #5A2A00;
    }

    .navbar {
        background-color: #FFE9C2 !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Style untuk search bar */
    .search-form {
        width: 50%;
        margin: 0 auto;
    }

    .input-group {
        height: 40px;
        /* Mengatur tinggi yang sama */
    }

    .search-input {
        height: 100%;
        border-radius: 0;
        border: 2px solid #5A2A00;
        border-right: none;
        padding: 0 15px;
    }

    .search-button {
        height: 100%;
        background-color: #5A2A00;
        color: white;
        border: 2px solid #5A2A00;
        border-left: none;
        padding: 0 25px;
        border-radius: 0;
    }

    .search-button:hover {
        background-color: #8B4513;
        border-color: #8B4513;
        color: white;
    }

    /* Hapus outline saat focus */
    .search-input:focus {
        box-shadow: none;
        border-color: #5A2A00;
    }

    /* Style untuk dropdown */
    .dropdown-menu {
        background-color: #5A2A00;
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .dropdown-item {
        color: #ffffff;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #DEAA79;
        color: white;
    }

    /* Tambahkan arrow indicator untuk dropdown */
    .dropdown-toggle::after {
        margin-left: 5px;
    }
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand brand-text" href="#">
            <span class="brand-colored">Kendaraan</span>Anda
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex search-form" role="search" action="/aku/userpanel/search.php" method="GET">
                <div class="input-group">
                    <input class="form-control search-input" type="search"
                        placeholder="Cari merk kendaraan..." name="search"
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <button class="btn search-button" type="submit">Search</button>
                </div>
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item me-4">
                    <a class="nav-link" href="../userpanel">Home</a>
                </li>
                <li class="nav-item dropdown me-4">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Kategori
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="kategori-mobil.php">Mobil</a></li>
                        <li><a class="dropdown-item" href="kategori-motor.php">Motor</a></li>
                        <li><a class="dropdown-item" href="kategori-sepeda.php">Sepeda</a></li>
                    </ul>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="keranjang.php">Keranjang</a>
                </li>
            </ul>
        </div>

    </div>
    </div>
</nav>