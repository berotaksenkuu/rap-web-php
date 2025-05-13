<style>
    .nav-link:hover {
        color: #ffffff;
        background-color: rgb(128, 60, 0);
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .brand-text {
        font-size: 30px;
        /* Ukuran font yang lebih besar */
        font-weight: bold;
    }

    .brand-colored {
        color: #5A2A00;
    }
</style>

<nav class="navbar navbar-expand-lg" style="background-color: #f5f5dc;">
    <div class="container-fluid">
        <a class="navbar-brand brand-text" href="#">
            <span class="brand-colored">Kendaraan</span>Anda
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse p-2" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-0 mb-2 mb-lg-0">
                <li class="nav-item me-4">
                    <a class="nav-link" href="../adminpanel">Home</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="../userpanel">Dashboard User</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>