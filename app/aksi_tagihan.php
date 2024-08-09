<?php

include("../config.php");
session_start();

date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['hitung'])) {
    $id_parkir = $_POST['id_parkir'];
    // $id_tarif = $_POST['id_tarif'];
    $nopolisi = $_POST['nopolisi'];
    $merk = $_POST['merk'];
    $jenis = $_POST['jenis'];
    $blok = $_POST['blok'];
    $petugas = $_POST['petugas'];

    $jammasuk = strtotime($_POST['jammasuk']);
    $jammasuk_mysql = date('Y-m-d H:i:s', $jammasuk);
    //tarif dan Jam Keluar tidak ngambil dari Formulir
    $jamkeluar = time();
    $jamkeluar_mysql = date('Y-m-d H:i:s', $jamkeluar);

    // Periksa apakah jam keluar lebih kecil dari jam masuk
    if ($jamkeluar < $jammasuk) {
        $jamkeluar += 86400; // Tambahkan 24 jam jika kendaraan keluar setelah tengah malam
    }

    // Hitung durasi parkir dalam jam
    $durasi_parkir = ceil(($jamkeluar - $jammasuk) / 3600); // Dalam jam

    // Query untuk mendapatkan tarif berdasarkan jenis kendaraan
    $query_tarif = "SELECT tarif FROM tbtarif_parkir WHERE Jenis='$jenis'";
    $hasil_tarif = mysqli_query($conn, $query_tarif);

    if (!$hasil_tarif) {
        // Jika query gagal, tampilkan pesan kesalahan
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Terjadi kesalahan dalam mengambil tarif parkir!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $data_tarif = mysqli_fetch_array($hasil_tarif);

    if (!$data_tarif) {
        // Jika tidak menemukan tarif yang sesuai, tampilkan pesan kesalahan
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Tarif tidak ditemukan untuk jenis kendaraan tersebut!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // $id_tarif = $data_tarif['id_tarif'];

    // Hitung tarif berdasarkan jenis kendaraan
    //TARIF BERDASARKAN DARI TABEL TBTARIF_PARKIR

    //jadi ketika Jenis Kendaraan berjenis tertentu maka data tarif akan mengambil Tarif sesuai
    //Jenis Kendaraan pada TBTARIF_PARKIR

    //cara 1
    if ($jenis == 'Motor') {
        $tarif_pertama = $data_tarif['tarif'];
        $tarif_per_jam = $data_tarif['tarif'];
    } elseif ($jenis == 'Mobil') {
        $tarif_pertama = $data_tarif['tarif'];
        $tarif_per_jam = $data_tarif['tarif'];
    } else {
        die("Jenis Kendaraan Tidak DITEMUKAN");
    }

    //cara 2
    // if ($id_tarif == '1') {
    //     $tarif_pertama = $data_tarif['tarif'];
    //     $tarif_per_jam = $data_tarif['tarif'];
    // } elseif ($id_tarif == '2') {
    //     $tarif_pertama = $data_tarif['tarif'];
    //     $tarif_per_jam = $data_tarif['tarif'];
    // }


    // Hitung tarif
    if ($durasi_parkir <= 1) {
        $tarif = $tarif_pertama; // Tarif pertama jika durasi parkir 1 jam atau kurang
    } else {
        $tarif = $tarif_pertama + ($durasi_parkir - 1) * $tarif_per_jam; // Tarif pertama ditambah dengan tarif per jam berikutnya
    }
    //echo "Tarif parkir untuk $jenis adalah: Rp $tarif";
    //echo "<script>alert('Tarif parkir untuk $jenis ini adalah: Rp $tarif');</script>"
    if ($tarif > 0) {
        $_SESSION['alertype'] = "Success";
        $_SESSION['alertmessage'] = "Tarif parkir untuk $jenis ini adalah: Rp $tarif";
    } else {
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Gagal Menghitung Tarif";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengendara Keluar Laporan - Parkeer App</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/parkirfav.png">

    <!-- FONT-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap/css/my.css">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>

    </style>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <img id="logo" src="../assets/logo_huruf.png" alt="" width="150">
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                PETUGAS
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MANAJEMEN
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-parking"></i>
                    <span>Parkir</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="parkir_masuk.php">Parkir Masuk</a>
                        <a class="collapse-item" href="parkir_keluar.php">Parkir Keluar</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
                        <a class="collapse-item" href="kendaraan_masuk.php">Kendaraan Masuk</a>
                        <a class="collapse-item" href="kendaraan_keluar.php">Kendaraan Keluar</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="../index.php" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Keluar</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">




        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form action="search.php" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search Here" aria-label="Search" aria-describedby="basic-addon2" name="keyword">
                            <div class="input-group-append">
                                <button class="btn search" type="submit">
                                    <i class="fas fa-search fa-sm" style="color: white"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle">
                                <span class="d-none d-lg-inline namaAdmin">
                                    <?= $_SESSION['petugas']; ?>
                                </span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>


                        <!-- Nav Item - User Information -->
                        <li class="nav-item no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <img class="img-profile rounded-circle" src="../assets/user1.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-200"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div class="container ml-2">

                    <!-- ALERT SUCCESS tarif nya adalah -->

                    <?php
                    if (isset($_SESSION['alertype']) && isset($_SESSION['alertmessage'])) {
                        $alertype = $_SESSION['alertype'];
                        $alertmessage = $_SESSION['alertmessage'];
                    ?>
                        <div class="alert alert-<?= $alertype ?> alert-dismissible fade show alert-success" role="alert">
                            <?= $alertmessage ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        unset($_SESSION['alertype']);
                        unset($_SESSION['alertmessage']);
                    }
                    ?>


                    <p class="hurufatas">Parkir</p>

                    <div class="mb-4"></div>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold textjudultabel">Parkir Keluar</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="aksi_laporan.php" method="post">

                                    <p class="text-center" style="font-size:30px; font-weight:500; color:#707070;">
                                        PENGENDARA KELUAR LAPORAN
                                    </p>

                                    <div class="ml-5 mr-5">


                                        <input type="hidden" name="id_parkir" value="<?php echo $id_parkir ?>">
                                        <input type="hidden" name="nopolisi" value="<?php echo $nopolisi ?>">
                                        <input type="hidden" name="merk" value="<?php echo $merk ?>">
                                        <input type="hidden" name="jenis" value="<?php echo $jenis ?>">
                                        <input type="hidden" name="blok" value="<?php echo $blok ?>">
                                        <input type="hidden" name="petugas" value="<?php echo $petugas ?>">


                                        <label for="JamMasuk" class="form-label">Jam Masuk</label>
                                        <input type="datetime-local" name="jammasuk" class="form-control mb-1" value="<?php echo $jammasuk_mysql ?>" readonly>

                                        <label for="JamKeluar" class="form-label">Jam Keluar</label>
                                        <input type="datetime-local" name="jamkeluar" class="form-control mb-1" value="<?php echo $jamkeluar_mysql ?>" readonly>

                                        <label for="tarif" class="form-label">Tarif</label>
                                        <input type="text" id="tarif" class="form-control mb-1" name="tarif" value="<?php echo $tarif_per_jam ?>" readonly>

                                        <label for="tagihan" class="form-label">Tagihan</label>
                                        <input type="text" id="tagihan" class="form-control mb-1" name="tagihan" value="<?php echo $tarif ?>" readonly>

                                        <div class="mb-4"></div>

                                        <input type="submit" value="Submit" name="kirim" class="btn btnsubmit">

                                </form>


                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <!-- End of Main Content -->


        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Parkeer 2024</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Keluar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Anda akan keluar dari sesi ini. Apakah Anda yakin ingin melanjutkan?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primarykeluar" href="../index.php">Keluar</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../vendor/bootstrap/js/sb-admin-2.min.js"></script>




</body>

</html>