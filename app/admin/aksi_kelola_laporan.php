<?php
include '../../config.php';
session_start();

$totalPendapatan = 0; // Variabel untuk menyimpan total pendapatan

if (isset($_GET['daritanggal']) && isset($_GET['sampaitanggal'])) {
    // Ambil nilai daritanggal dan sampaitanggal dari URL
    $daritanggal = $_GET['daritanggal'];
    $sampaitanggal = $_GET['sampaitanggal'];
    $sql = "SELECT * FROM tbpengendara_keluar WHERE DATE(Jam_Keluar) BETWEEN '$daritanggal' AND '$sampaitanggal';";
    $query = mysqli_query($conn, $sql);

    $finaldata = [];
    while ($pengendara = mysqli_fetch_array($query)) {
        $finaldata[] = $pengendara;
        $totalPendapatan += $pengendara['Tagihan']; // Tambahkan nilai Tagihan ke total pendapatan
    }
}

// Cek jika tombol export diklik
if (isset($_POST['export'])) {
    // Tentukan nama file
    $filename = "LaporanParkir-" . date('Y-m-d') . ".xls";

    // Set header untuk file Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    // Tulis header tabel ke file Excel
    echo "No Laporan\tKode Parkir\tNo Polisi\tMerk\tJenis Kendaraan\tBlok\tJam Masuk\tJam Keluar\tTarif\tTagihan\tPetugas\n";

    // Tulis data ke file Excel
    foreach ($finaldata as $data) {
        echo $data['No_Laporan'] . "\t" . $data['id_parkir'] . "\t" . $data['No_Polisi'] . "\t" . $data['Merk'] . "\t" . $data['Jenis'] . "\t" . $data['Blok'] . "\t" . $data['Jam_Masuk'] . "\t" . $data['Jam_Keluar'] . "\t" . $data['Tarif'] . "\t" . $data['Tagihan'] . "\t" . $data['Petugas'] . "\n";
    }

    // Output total pendapatan dengan tanda kutip
    echo "\t\t\t\t\t\t\t\t\tTotal Pendapatan\t'" . number_format($totalPendapatan, 0, ',', '.') . "'\n";


    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sortir Data - Parkeer App</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../assets/parkirfav.png">

    <!-- FONT-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- CSS-->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../vendor/bootstrap/css/my.css">

    <!-- DATATABLES -->


    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



    <style>
        .btn-success:hover {
            border-color: #07689f;
            background-color: #07689f;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #07689f;
            border-color: #07689f;
        }

        .textket {

            color: #07689f;
        }
    </style>

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
            <li class="nav-item active">
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
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-200"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div class="container ml-2">
                    <!-- ALERT SUCCESS DATA BERHASIL DISIMPAN -->

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

                    <!-- ALERT DANGER DATA TIDAK DISIMPAN -->
                    <?php
                    if (isset($_SESSION['alertype1']) && isset($_SESSION['alertmessage1'])) {
                        $alertype1 = $_SESSION['alertype1'];
                        $alertmessage1 = $_SESSION['alertmessage1'];
                    ?>
                        <div class="alert alert-<?= $alertype1 ?> alert-dismissible fade show alert-danger" role="alert">
                            <?= $alertmessage1 ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        unset($_SESSION['alertype1']);
                        unset($_SESSION['alertmessage1']);
                    }
                    ?>
                    <p class="hurufatas">Kelola</p>

                    <div class="mb-4"></div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold textjudultabel">
                                Laporan Parkir
                            </h6>

                        </div>
                        <div class="card-body">
                            <p class="m-0 font-weight-bold textket mb-3 ">
                                Dari Tanggal
                                <span style="color: #0988d0;"><?php echo $daritanggal; ?></span>
                                Sampai Tanggal
                                <span style="color: #0988d0;"><?php echo $sampaitanggal; ?></span>
                            </p>
                            <div class="mb-2"></div>

                            <form method="post">
                                <button type="submit" class="btn btn-success" name="export" class="mb-2">
                                    <span class="pr-1">Ekspor ke Excel</span>
                                    <i class="fas fa-file-excel fa-lg"></i>
                                </button>
                            </form>

                            <div class="mb-3"></div>

                            <div class="table-responsive">







                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" class="mt-5">
                                    <thead>
                                        <tr>
                                            <th>No Laporan</th>
                                            <th>Kode Parkir</th>
                                            <th>No Polisi</th>
                                            <th>Merk</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Blok</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Tarif</th>
                                            <th>Tagihan</th>
                                            <th>Petugas</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hasilPencarian">
                                        <?php
                                        // Data yang akan ditampilkan
                                        $totalPendapatan = 0; // Variabel untuk menyimpan total pendapatan

                                        if (isset($_GET['daritanggal']) && isset($_GET['sampaitanggal'])) {
                                            // Ambil nilai daritanggal dan sampaitanggal dari URL
                                            $daritanggal = $_GET['daritanggal'];
                                            $sampaitanggal = $_GET['sampaitanggal'];
                                            $sql = "SELECT * FROM tbpengendara_keluar WHERE DATE(Jam_Keluar) BETWEEN '$daritanggal' AND '$sampaitanggal';";
                                            $query = mysqli_query($conn, $sql);

                                            while ($pengendara = mysqli_fetch_array($query)) {
                                                echo "<tr>";
                                                echo "<td>" . $pengendara['No_Laporan'] . "</td>";
                                                echo "<td>" . $pengendara['id_parkir'] . "</td>";
                                                echo "<td>" . $pengendara['No_Polisi'] . "</td>";
                                                echo "<td>" . $pengendara['Merk'] . "</td>";
                                                echo "<td>" . $pengendara['Jenis'] . "</td>";
                                                echo "<td>" . $pengendara['Blok'] . "</td>";
                                                echo "<td>" . $pengendara['Jam_Masuk'] . "</td>";
                                                echo "<td>" . $pengendara['Jam_Keluar'] . "</td>";
                                                echo "<td>" . $pengendara['Tarif'] . "</td>";
                                                echo "<td>" . $pengendara['Tagihan'] . "</td>";
                                                echo "<td>" . $pengendara['Petugas'] . "</td>";
                                                echo "</tr>";

                                                // Tambahkan nilai Tagihan ke total pendapatan
                                                $totalPendapatan += $pengendara['Tagihan'];
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="10">Total Pendapatan</th>
                                            <th><?php echo number_format($totalPendapatan, 0, ',', '.'); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>









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
                        <a class="btn btn-primarykeluar" href="../../index.php">Keluar</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- jQuery -->
        <script src="../../vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap core JavaScript-->
        <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- DataTables -->
        <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>


        <!-- Your custom scripts -->
        <script>
            $(document).ready(function() {
                var table = $('#dataTable').DataTable({
                    searching: true, // Aktifkan fitur pencarian
                    paging: true, // Nonaktifkan paging
                    info: true, // Nonaktifkan informasi jumlah entri
                    language: {
                        url: '../../vendor/datatables/Indonesian.json'
                        // url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
                    },
                });
            });
        </script>
</body>

</html>