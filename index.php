<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Bank Sampah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3f6f9;
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            min-height: 100vh;
        }

        #content {
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex-grow: 1;
        }

        /* --- Sidebar Style (Updated with green gradient) --- */
        #sidebar {
            min-width: 180px;
            max-width: 180px;
            background: linear-gradient(to bottom, #1abc9c, #16a085);
            color: #fff;
            transition: all 0.3s;
        }

        #sidebar.active {
            margin-left: -180px;
        }

        #sidebar .sidebar-header {
            padding: 25px 10px 15px;
            background: linear-gradient(to bottom, #1abc9c, #16a085);
            /* Menggunakan gradasi yang sama dengan sidebar */
            text-align: center;
        }

        #sidebar .sidebar-header .logos {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        #sidebar .sidebar-header .logos img {
            max-height: 40px;
        }

        #sidebar .sidebar-header h5 {
            margin-top: 12px;
            font-size: 0.85rem;
            color: #ecf0f1;
        }

        #sidebar ul.components {
            padding: 15px 0;
        }

        #sidebar ul li a {
            padding: 10px 15px;
            font-size: 0.9em;
            display: block;
            color: #e0f7f1;
            text-decoration: none;
            transition: all 0.2s;
        }

        #sidebar ul li a:hover {
            color: #ffffff;
            background: rgba(0, 0, 0, 0.1);
        }

        #sidebar ul li a i {
            margin-right: 10px;
        }

        /* --- Content Style --- */
        #content {
            width: 100%;
            padding: 0;
            transition: all 0.3s;
        }

        .navbar {
            padding: 10px 20px;
            /* Perubahan di sini: Mengubah background navbar menjadi gradasi hijau */
            background: linear-gradient(to right, #1abc9c, #16a085);
            /* Gradasi hijau yang sama dengan sidebar */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        /* Menyesuaikan warna tombol di navbar */
        .navbar .btn-sm {
            padding: 0.15rem 0.4rem;
            font-size: 0.8rem;
        }

        /* Mengubah warna tombol toggle sidebar agar sesuai dengan background navbar */
        .navbar .btn-outline-secondary {
            color: #fff;
            /* Warna teks tombol */
            border-color: #fff;
            /* Warna border tombol */
        }

        .navbar .btn-outline-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            /* Background hover tombol */
            color: #fff;
        }

        /* Menyesuaikan warna tombol logout */
        .navbar .btn-outline-danger {
            color: #fff;
            /* Warna teks tombol logout */
            border-color: #f1c40f;
            /* Warna border tombol logout yang lebih kontras */
            background-color: #f39c12;
            /* Background tombol logout */
        }

        .navbar .btn-outline-danger:hover {
            background-color: #e67e22;
            /* Background hover tombol logout */
            border-color: #e67e22;
            color: #fff;
        }

        /* Mengubah warna teks "Selamat datang, Admin!" */
        .navbar .small {
            color: #ecf0f1;
            /* Warna teks agar kontras dengan background gradasi hijau */
        }

        /* --- Tambahan CSS untuk background gradasi pada info Admin dan Logout --- */
        /* Dihapus karena navbar sudah full gradasi, elemen ini akan mengikuti background parent */
        /* .navbar-info-admin {
            background: linear-gradient(to right, #d4edda, #c3e6cb);
            padding: 5px 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        } */

        /* .navbar-info-admin .small {
            color: #155724;
        } */
        /* --- Akhir Tambahan CSS --- */


        .main-content {
            padding: 20px 30px;
        }

        /* --- Style untuk Kartu Menu di Dashboard --- */
        .menu-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .menu-card .icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .menu-card .title {
            font-weight: 600;
            font-size: 1rem;
            color: #333;
        }

        /* --- Footer Style --- */
        footer {
            text-align: center;
            padding: 12px 15px;
            background-color: #ffffff;
            margin-top: auto;
            border-top: 1px solid #e9ecef;
        }

        footer .footer-title {
            font-size: 0.85rem;
            font-weight: 600;
            color: #495057;
        }

        footer .copyright {
            font-size: 0.7rem;
            color: #6c757d;
        }

        /* --- Responsive --- */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -180px;
            }

            #sidebar.active {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="logos">
                    <img src="https://i.imgur.com/n0Zz98i.png" alt="Logo LPPM">
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjrbmVRfLrLQ_W0S8TyeY-ITGn2b4USxdM0xVBBliS2O8CpZKeGhIj_wDGJDcGJrLP3Y_z-5GPlZ5B8K1bc6bIfOGrDfwUY523y9eaevm1tY6dd3oxnKa7Mqa_pdjTckw0DqxNNm3-XS90/s1600/LOGO+USMJAYA.png" alt="Logo USM">
                </div>
                <h5 class="mt-2">Bank Sampah RT 3 / RW 2 Kelurahan Mlatiharjo</h5>
            </div>

            <ul class="list-unstyled components">
                <p class="px-3" style="font-size: 0.8rem;">Menu Navigasi</p>
                <li><a href="daftar_jenis_sampah.php"><i class="bi bi-recycle"></i>Jenis Sampah</a></li>
                <li><a href="tambah_nasaba.php"><i class="bi bi-person-plus-fill"></i>Tambah Nasabah</a></li>
                <li><a href="daftar_nasaba.php"><i class="bi bi-people-fill"></i>Daftar Nasabah</a></li>
                <li><a href="tambah_setoran.php"><i class="bi bi-arrow-down-circle-fill"></i>Tambah Setoran</a></li>
                <li><a href="laporan.php"><i class="bi bi-bar-chart-line-fill"></i>Laporan Setoran</a></li>
                <li><a href="penjualan.php"><i class="bi bi-cash-coin"></i>Penjualan Sampah</a></li>
            </ul>
        </nav>

        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="d-flex align-items-center ms-auto">
                        <span class="me-3 d-none d-sm-inline small">Selamat datang, Admin!</span>
                        <a href="logout.php" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-box-arrow-right"></i> <span class="d-none d-md-inline">Logout</span>
                        </a>
                    </div>
                </div>
            </nav>

            <div class="main-content">
                <h3 class="fw-bold mb-4">Dashboard</h3>

                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <a href="tambah_nasaba.php" class="text-decoration-none">
                            <div class="menu-card">
                                <i class="bi bi-person-plus-fill icon text-success"></i>
                                <div class="title">Tambah Nasabah</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="daftar_nasaba.php" class="text-decoration-none">
                            <div class="menu-card">
                                <i class="bi bi-people-fill icon text-primary"></i>
                                <div class="title">Daftar Nasabah</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="tambah_setoran.php" class="text-decoration-none">
                            <div class="menu-card">
                                <i class="bi bi-arrow-down-circle-fill icon text-warning"></i>
                                <div class="title">Tambah Setoran</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="daftar_jenis_sampah.php" class="text-decoration-none">
                            <div class="menu-card">
                                <i class="bi bi-recycle icon text-success"></i>
                                <div class="title">Jenis Sampah</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <a href="laporan.php" class="text-decoration-none">
                            <div class="menu-card">
                                <i class="bi bi-bar-chart-line-fill icon text-info"></i>
                                <div class="title">Laporan Setoran</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="penjualan.php" class="text-decoration-none">
                            <div class="menu-card">
                                <i class="bi bi-cash-coin icon text-dark"></i>
                                <div class="title">Penjualan Sampah</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <footer>
                <div class="footer-title">Sistem Informasi Bank Sampah</div>
                <div class="copyright">&copy; 2025 Bank Sampah RT 3 / RW 2 Kelurahan Mlatiharjo| KKN USM</div>
            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('sidebarCollapse').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('active');
            });
        });
    </script>

</body>

</html>