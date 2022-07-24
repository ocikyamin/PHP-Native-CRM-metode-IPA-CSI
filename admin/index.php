<?php
session_start();
include '../env.php';
include 'count.php';
if (!isset($_SESSION['userLogin'])) {
    echo "<script>location = '../auth/';</script>";
}
$userLogin = intval(base64_decode($_SESSION['userLogin']));
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE id=$userLogin  "));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>CRM - Usiusi Interior</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="../public/assets/img/favicon.png" rel="icon">
    <link href="../public/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="../public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../public/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="../public/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="./" class="logo d-flex align-items-center">
                <img src="../public/brand.png" alt="">
                <span class="d-none d-lg-block">CRM</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
        <div class="search-bar">
            <b>USIUSI</b> INTERIOR
        </div><!-- End Search Bar -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#">
                        <img src="../public/assets/img/usiusi.png" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block ps-2"> <?= $user['username'] ?> </span>
                    </a><!-- End Profile Iamge Icon -->
                </li><!-- End Profile Nav -->
            </ul>
        </nav><!-- End Icons Navigation -->
    </header><!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="./">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Masters</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?/=atribut">
                            <i class="bi bi-circle"></i><span>Atribut</span>
                        </a>
                    </li>
                    <li>
                        <a href="?/=pendidikan">
                            <i class="bi bi-circle"></i><span>Pendidikan</span>
                        </a>
                    </li>
                    <li>
                        <a href="?/=pekerjaan">
                            <i class="bi bi-circle"></i><span>Pekerjaan </span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>CRM</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?/=responden">
                            <i class="bi bi-circle"></i><span>Responden</span>
                        </a>
                    </li>
                    <li>
                        <a href="?/=analyze">
                            <i class="bi bi-circle"></i><span>Analysis </span>
                        </a>
                    </li>
                </ul>

            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#commerce-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-cart"></i><span>E-Commerce</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="commerce-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="?/=product">
                            <i class="bi bi-circle"></i><span>Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="?/=transaksi">
                            <i class="bi bi-circle"></i><span>Transaksi </span>
                        </a>
                    </li>
                    <li>
                        <a href="?/=pembayaran">
                            <i class="bi bi-circle"></i><span>Pembayaran </span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="?/=penjualan">
                            <i class="bi bi-circle"></i><span>Penjualan </span>
                        </a>
                    </li> -->


                </ul>

            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="?/=pelanggan">
                    <i class="bi bi-people"></i>
                    <span>Pelanggan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="?/=account">
                    <i class="bi bi-gear"></i>
                    <span>Account</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="../auth/logOut.php">
                    <i class="bi bi-box-arrow-in-left"></i>

                    <span>Logout</span>
                </a>
            </li><!-- End Blank Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->
    <main id="main" class="main">
        <?php
        if (isset($_GET['/'])) {
            $view = $_GET['/'];
            if ($view == 'atribut') {
                include "Masters/atribut.php";
            } elseif ($view == 'pendidikan') {
                include "Masters/pendidikan.php";
            } elseif ($view == 'pekerjaan') {
                include "Masters/pekerjaan.php";
            }
            // Analisis
            elseif ($view == 'analyze') {
                include 'CRM/skors.php';
            } elseif ($view == 'responden') {
                include 'CRM/responden.php';
            }
            // all notif
            elseif ($view == 'all-notif') {
                include 'Views/allNotif.php';
            }

            // commerce 
            elseif ($view == 'product') {
                include 'Commerce/produk/index.php';
            } elseif ($view == 'transaksi') {
                include 'Commerce/transaksi/index.php';
            } elseif ($view == 'invoice') {
                include 'Commerce/transaksi/invoice.php';
            } elseif ($view == 'pembayaran') {
                include 'Commerce/pembayaran/index.php';
            } elseif ($view == 'penjualan') {
                include 'Commerce/penjualan/index.php';
            }
            // pelanggan 
            elseif ($view == 'pelanggan') {
                include 'Pelanggan/index.php';
            }
            // Account 
            elseif ($view == 'account') {
                include 'Account.php';
            }
        } else {
            include 'dashboard.php';
        }

        ?>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Usiusi INterior</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../public/assets/vendor/chartjs/chart.min.js"></script>
    <!-- <script src="../public/assets/vendor/apexcharts/apexcharts.min.js"></script> -->
    <script src="../public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- <script src="../public/assets/vendor/quill/quill.min.js"></script> -->
    <script src="../public/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <!-- Template Main JS File -->
    <script src="../public/assets/js/main.js"></script>

</body>

</html>
