<?php
include '../../config.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - Parkeer App</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../assets/parkirfav.png">

    <!-- FONT-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- CSS-->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../vendor/bootstrap/css/my.css">

    <style>
        .hasil {
            color: #07689f;
        }

        .id-parkir {
            color: black;
        }

        .text-id-parkir {
            color: #07689f;
        }
    </style>

    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <img id="logo" src="../../assets/logo_huruf.png" alt="" width="150">
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                ADMIN
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
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-parking"></i>
                    <span>Parkir</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="petugas-sementara/parkir_masuk.php">Parkir Masuk</a>
                        <a class="collapse-item" href="petugas-sementara/parkir_keluar.php">Parkir Keluar</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-cogs"></i>
                    <span>Kelola</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="kelola_petugas.php">Kelola Petugas</a>
                        <a class="collapse-item" href="kelola_kendaraan.php">Kelola Kendaraan</a>
                        <a class="collapse-item" href="kelola_tarif.php">Kelola Tarif</a>
                        <a class="collapse-item" href="kelola_laporan.php">Kelola Laporan</a>
                        <a class="collapse-item" href="kelola_blok.php">Kelola Blok</a>
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
                        <a class="collapse-item" href="rekapan_masuk.php">Rekapan Masuk</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="../../index.php" data-toggle="modal" data-target="#logoutModal">
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
                                    <?= $_SESSION['admin']; ?>
                                </span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>


                        <!-- Nav Item - User Information -->
                        <li class="nav-item no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <img class="img-profile rounded-circle" src="../../assets/user1.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="container">
                    <?php
                    // Include koneksi database
                    include '../../config.php';

                    // Periksa apakah parameter pencarian (keyword) telah dikirimkan
                    if (isset($_GET['keyword'])) {
                        // Tangkap nilai keyword dari parameter GET
                        $keyword = $_GET['keyword'];

                        // Query untuk mencari data berdasarkan keyword di tabel tbpengendara_masuk
                        $query_masuk = "SELECT * FROM tbpengendara_masuk WHERE id_parkir LIKE '%$keyword%' OR No_Polisi LIKE '%$keyword%' OR Merk LIKE '%$keyword%' OR Jenis LIKE '%$keyword%' OR Blok LIKE '%$keyword%' OR Jam_Masuk LIKE '%$keyword%' OR Petugas LIKE '%$keyword%'";
                        $result_masuk = mysqli_query($conn, $query_masuk);

                        // Query untuk mencari data berdasarkan keyword di tabel tbpengendara_keluar
                        $query_keluar = "SELECT * FROM tbpengendara_keluar WHERE No_Laporan LIKE '%$keyword%' OR id_parkir LIKE '%$keyword%' OR No_Polisi LIKE '%$keyword%' OR Merk LIKE '%$keyword%' OR Jenis LIKE '%$keyword%' OR Blok LIKE '%$keyword%' OR Jam_Masuk LIKE '%$keyword%' OR Jam_Keluar LIKE '%$keyword%' OR Tagihan LIKE '%$keyword%' OR Petugas LIKE '%$keyword%'";
                        $result_keluar = mysqli_query($conn, $query_keluar);

                        // Query untuk mencari data berdasarkan keyword di tabel tbrekap_masuk
                        $query_rekap = "SELECT * FROM tbrekapan_masuk WHERE id_parkir LIKE '%$keyword%' OR No_Polisi LIKE '%$keyword%' OR Merk LIKE '%$keyword%' OR Jenis LIKE '%$keyword%' OR Blok LIKE '%$keyword%' OR Jam_Masuk LIKE '%$keyword%' OR Petugas LIKE '%$keyword%'";
                        $result_rekap = mysqli_query($conn, $query_rekap);

                        // Tampilkan hasil pencarian untuk tbpengendara_masuk
                        echo "<h2 class='hasil'>Hasil Pencarian untuk Kendaraan Masuk:</h2>";
                        echo "<div class='mb-4'></div>";
                        if (mysqli_num_rows($result_masuk) > 0) {
                            echo "<div class='row'>";
                            while ($row = mysqli_fetch_assoc($result_masuk)) {
                                echo "<div class='col-md-6 mb-4'>";
                                echo "<div class='card'>";
                                echo "<div class='card-body'>";
                                echo "<h5 class='card-title id-parkir font-weight-bold'>Kode Parkir: " . $row['id_parkir'] . "</h5>";
                                echo "<p class='card-text'>No Polisi: " . $row['No_Polisi'] . "</p>";
                                echo "<p class='card-text'>Merk: " . $row['Merk'] . "</p>";
                                echo "<p class='card-text'>Jenis: " . $row['Jenis'] . "</p>";
                                echo "<p class='card-text'>Blok: " . $row['Blok'] . "</p>";
                                echo "<p class='card-text'>Jam Masuk: " . $row['Jam_Masuk'] . "</p>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                            echo "</div>";
                        } else {
                            echo "<p>Tidak ada hasil yang ditemukan untuk Kendaraan Masuk.</p>";
                        }

                        // Tampilkan hasil pencarian untuk tbpengendara_keluar
                        echo "<h2 class='mt-0 mb-4 hasil'>Hasil Pencarian untuk Kendaraan Keluar:</h2>";
                        echo "<div class='mb-4'></div>";
                        if (mysqli_num_rows($result_keluar) > 0) {
                            echo "<div class='row'>";
                            while ($row = mysqli_fetch_assoc($result_keluar)) {
                                echo "<div class='col-md-6 mb-4'>";
                                echo "<div class='card'>";
                                echo "<div class='card-body'>";
                                echo "<h5 class='card-title id-parkir font-weight-bold'>No Laporan: " . $row['No_Laporan'] . "</h5>";
                                echo "<p class='card-text text-id-parkir'>Kode Parkir: " . $row['id_parkir'] . "</p>";
                                echo "<p class='card-text'>No Polisi: " . $row['No_Polisi'] . "</p>";
                                echo "<p class='card-text'>Merk: " . $row['Merk'] . "</p>";
                                echo "<p class='card-text'>Jenis: " . $row['Jenis'] . "</p>";
                                echo "<p class='card-text'>Blok: " . $row['Blok'] . "</p>";
                                echo "<p class='card-text'>Jam Masuk: " . $row['Jam_Masuk'] . "</p>";
                                echo "<p class='card-text'>Jam Keluar: " . $row['Jam_Keluar'] . "</p>";
                                echo "<p class='card-text'>Tagihan: " . $row['Tagihan'] . "</p>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                            echo "</div>";
                        } else {
                            echo "<p>Tidak ada hasil yang ditemukan untuk Kendaraan Keluar.</p>";
                        }


                        // Tampilkan hasil pencarian untuk tbrekapan_masuk
                        echo "<h2 class='hasil'>Hasil Pencarian untuk Rekap Kendaraan Masuk:</h2>";
                        echo "<div class='mb-4'></div>";
                        if (mysqli_num_rows($result_rekap) > 0) {
                            echo "<div class='row'>";
                            while ($row = mysqli_fetch_assoc($result_rekap)) {
                                echo "<div class='col-md-6 mb-4'>";
                                echo "<div class='card'>";
                                echo "<div class='card-body'>";
                                echo "<h5 class='card-title id-parkir font-weight-bold'>Kode Parkir: " . $row['id_parkir'] . "</h5>";
                                echo "<p class='card-text'>No Polisi: " . $row['No_Polisi'] . "</p>";
                                echo "<p class='card-text'>Merk: " . $row['Merk'] . "</p>";
                                echo "<p class='card-text'>Jenis: " . $row['Jenis'] . "</p>";
                                echo "<p class='card-text'>Blok: " . $row['Blok'] . "</p>";
                                echo "<p class='card-text'>Jam Masuk: " . $row['Jam_Masuk'] . "</p>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                            echo "</div>";
                        } else {
                            echo "<p>Tidak ada hasil yang ditemukan untuk Rekap Kendaraan Masuk.</p>";
                        }
                    } else {
                        // Jika parameter pencarian tidak ada
                        echo "<h2>Silakan masukkan kata kunci untuk melakukan pencarian.</h2>";
                    }


                    ?>
                    <!-- <a href="javascript:history.back()" class="back-btn">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a> -->
                </div>


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
                    <a class="btn btn-primarykeluar" href="../../index.php">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../vendor/bootstrap/js/sb-admin-2.min.js"></script>



</body>




</html>