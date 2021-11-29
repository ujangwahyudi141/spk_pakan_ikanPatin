<?php
require './proses/function.php';
// require 'cek.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SPK Pakan Alami Patin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark btn-primary">
        <a class="navbar-brand mt-5" href="index1.php?page=dashboard">
            <img src="circle-cropped.png" class="d-flex justify-align-center" alt="" style="width: 5rem;">
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <div class="text">
            <marquee style="font-family: times new roman; font-size:20px; color:#ffffff">SISTEM PENUNJANG KEPUTUSAN PEMILIHAN PAKAN IKAN PATIN</marquee>
        </div>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark bg-primary" id="sidenavAccordion">
                <div class="sb-sidenav-menu mt-5">
                    <div class="nav">
                        <?php
                        if ($_SESSION['level'] == 1) :
                        ?>
                            <a class="nav-link active" href="index1.php?page=form-beranda">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Beranda
                            </a>
                            <a class="nav-link active" href="index1.php?page=form-pengguna">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Pengguna
                            </a>
                            <a class="nav-link active" href="index1.php?page=form-kriteria">
                                <div class="sb-nav-link-icon"><i class="fas fa-check"></i></div>
                                Kriteria
                            </a>
                            <a class="nav-link active" href="index1.php?page=form-pakan">
                                <div class="sb-nav-link-icon"><i class="fas fa-check"></i></div>
                                Pakan
                            </a>
                            <a class="nav-link active" href="index1.php?page=form-penilaian">
                                <div class="sb-nav-link-icon"><i class="fas fa-check"></i></div>
                                Penilaian
                            </a>
                        <?php endif ?>
                        <a class="nav-link active" href="index1.php?page=saw">
                            <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                            Keputusan SAW
                        </a>
                        <a class="nav-link active" href="index1.php?page=topsis&k=nilai_matriks">
                            <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                            Keputusan Topsis
                        </a>
                        <a class="nav-link active" href="index.php?page=logout" onclick="return confirm('Logout ?')">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>

                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];

                    switch ($page) {
                        case 'form-beranda';
                            include 'dashboard.php';
                            break;
                        case 'form-pengguna';
                            include 'pengguna.php';
                            break;
                        case 'form-kriteria';
                            include 'kriteria.php';
                            break;
                        case 'form-pakan';
                            include 'pakan.php';
                            break;
                        case 'form-penilaian';
                            include 'penilaian.php';
                            break;
                        case 'logout';
                            include 'logout.php';
                            break;
                        case 'dashboard';
                            include 'dashboard.php';
                            break;
                        case 'saw';
                            include 'keputusan_saw.php';
                            break;
                        case 'topsis';
                            // include 'keputusan_topsis.php';
                            include 'perhitungan_topsis.php';
                            break;
                        case 'registrasi';
                            include 'registrasi.php';
                            break;
                    }
                }
                ?>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Created By Ayu Setiyaningsih &copy; STMIK Horizon Karawang 2021</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <script>
        function ceta(el) {
            var printpage = document.getElementById(el).innerHTML;
            var oripage = document.body.innerHTML;
            document.body.innerHTML = printpage;
            window.print();
            document.body.innerHTML = oripage;
        }
    </script>
</body>

</html>