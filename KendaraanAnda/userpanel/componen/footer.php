<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-3 border-top">
                <li class="list-inline-item text-light">
                    <a href="https://www.instagram.com/billlllll_real/" class="text-light text-decoration-none">
                        <i class="fab fa-instagram fa-2x"></i> Instagram
                    </a>
                </li>
                <li class="list-inline-item text-light">
                    <a href="https://wa.me/6282285168800" class="text-light text-decoration-none">
                        <i class="fab fa-whatsapp fa-2x"></i> Whatsapp
                    </a>
                </li>
                <p class="text-light mb-0">&copy; <?php echo date('Y'); ?> KendaraanAnda. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
        background-color: transparent;
        padding: 10px 0;
        color: #FFE9C2;
        margin-top: auto;
    }

    .footer p {
        float: right;
    }

    .footer li {
        float: left;
    }


    /* Tambahkan style untuk memastikan footer di bawah */
    html {
        height: 100%;
    }

    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Tambahkan margin untuk card container */
    .container {
        margin-bottom: 10px;
    }

    /* Atau jika menggunakan class row khusus untuk cards */
    .row {
        margin-bottom: 10px;
    }
</style>