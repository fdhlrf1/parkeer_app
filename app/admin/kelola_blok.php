<?php
include '../../config.php';
session_start();

// Ambil daftar semua blok dari tabel tbblok_parkir
$sql_blok = "SELECT DISTINCT Blok FROM tbblok_parkir";
$query_blok = mysqli_query($conn, $sql_blok);

// Fungsi untuk mengambil detail blok
function getBlokDetail($conn, $blok)
{
    $query = mysqli_query($conn, "SELECT * FROM tbblok_parkir WHERE Blok = '$blok'");
    return mysqli_fetch_assoc($query);
}

// Fungsi untuk mengambil pengendara berdasarkan blok
function getPengendaraByBlok($conn, $blok)
{
    $sql = "SELECT * FROM tbpengendara_masuk WHERE Blok = '$blok'";
    return mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Blok - Parkeer App</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../assets/parkirfav.png">

    <!-- FONT-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- CSS-->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../vendor/bootstrap/css/my.css">

    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #07689f;
            border-color: #07689f;
        }



        .btnedit:hover {
            background-color: #fcb400;
            border-color: #fcb400;
        }

        .btnedit {

            width: 70px;
        }

        .btn-success:hover {
            border-color: #16835b;
            background-color: #16835b;
        }

        .btn-danger:hover {
            border-color: #eb0606;
            background-color: #eb0606;
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
            <li class="nav-item ">
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

                    <!-- ALERT tambah sukses -->
                    <?php
                    if (isset($_SESSION['alertype_tbh']) && isset($_SESSION['alertmessage_tbh'])) {
                        $alertype_tbh = $_SESSION['alertype_tbh'];
                        $alertmessage_tbh = $_SESSION['alertmessage_tbh'];
                    ?>
                        <div class="alert alert-<?= $alertype_tbh ?> alert-dismissible fade show alert-success" role="alert">
                            <?= $alertmessage_tbh ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        unset($_SESSION['alertype_tbh']);
                        unset($_SESSION['alertmessage_tbh']);
                    }
                    ?>


                    <!-- ALERT edit sukses -->
                    <?php
                    if (isset($_SESSION['alertype_edt']) && isset($_SESSION['alertmessage_edt'])) {
                        $alertype_edt = $_SESSION['alertype_edt'];
                        $alertmessage_edt = $_SESSION['alertmessage_edt'];
                    ?>
                        <div class="alert alert-<?= $alertype_edt ?> alert-dismissible fade show alert-success" role="alert">
                            <?= $alertmessage_edt ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        unset($_SESSION['alertype_edt']);
                        unset($_SESSION['alertmessage_edt']);
                    }
                    ?>

                    <!-- ALERT hapus sukses -->
                    <?php
                    if (isset($_SESSION['alertype_hps']) && isset($_SESSION['alertmessage_hps'])) {
                        $alertype_hps = $_SESSION['alertype_hps'];
                        $alertmessage_hps = $_SESSION['alertmessage_hps'];
                    ?>
                        <div class="alert alert-<?= $alertype_hps ?> alert-dismissible fade show alert-success" role="alert">
                            <?= $alertmessage_hps ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        unset($_SESSION['alertype_hps']);
                        unset($_SESSION['alertmessage_hps']);
                    }
                    ?>

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
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold textjudultabel">Kelola Blok Parkir</h6>
                        </div>
                        <div class="card-body">
                            <a href="crud/tambah_blok.php" class="btn btn-success mr-4 btntambah">Tambah</a>
                            <div class="mb-4"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Blok</th>
                                            <th>Total Tempat</th>
                                            <th>Terisi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="hasilPencarian">
                                        <?php
                                        // Mengambil semua data blok parkir dan menampilkan dalam tabel
                                        $sql = "SELECT * FROM tbblok_parkir";
                                        $query = mysqli_query($conn, $sql);

                                        while ($blokparkir = mysqli_fetch_array($query)) {
                                            echo "<tr>";
                                            echo "<td>" . $blokparkir['Blok'] . "</td>";
                                            echo "<td>" . $blokparkir['Total_Tempat'] . "</td>";
                                            echo "<td>" . $blokparkir['Terisi'] . "</td>";
                                            echo "<td class='text-center align-middle'>";
                                            echo "<div class='d-flex justify-content-center'>";
                                            echo "<a href='crud/edit_blok.php?id_blok=" . $blokparkir['id_blok'] . "' class='btn btn-warning btnedit mr-4'>Edit</a>";
                                            echo "<a href='crud/hapus_blok.php?id_blok=" . $blokparkir['id_blok'] . "' class='btn btn-danger btnhapus'>Hapus</a>";
                                            echo "</div>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php
                    // Membuat tabel untuk setiap blok secara dinamis
                    while ($row_blok = mysqli_fetch_assoc($query_blok)) {
                        $blok = $row_blok['Blok'];
                        $blokDetail = getBlokDetail($conn, $blok);
                        $TotalTempat = $blokDetail['Total_Tempat'];
                        $Terisi = $blokDetail['Terisi'];

                        echo "
    <div class='card shadow mb-4'>
        <div class='card-header py-3 d-flex justify-content-between align-items-center'>
            <h6 class='m-0 font-weight-bold textjudultabel'>Blok Parkir $blok</h6>
            <div class='d-flex align-items-center'>
                <h6 class='m-0 font-weight-bold textjudultabel' style='font-size: 17px;'>Terisi :</h6>
                <h6 style='font-size: 17px; margin: 0 20px 0 6px; font-weight: bold;' class='textjudultabel'>$Terisi</h6>
                <h6 class='m-0 font-weight-bold textjudultabel' style='font-size: 17px; margin-left: 20px;'>Tersedia :</h6>
                <h6 style='font-size: 17px; margin: 0 0 0 6px; font-weight: bold;' class='textjudultabel'>$TotalTempat</h6>
            </div>
        </div>
        <div class='card-body'>
            <div class='table-responsive'>
                <table class='table table-bordered' id='dataTable_$blok' width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Kode Parkir</th>
                            <th>No Polisi</th>
                            <th>Merk</th>
                            <th>Jenis Kendaraan</th>
                            <th>Blok</th>
                            <th>Jam Masuk</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody id='hasilPencarian'>";

                        $query_pengendara = getPengendaraByBlok($conn, $blok);
                        while ($pengendara = mysqli_fetch_array($query_pengendara)) {
                            echo "
        <tr>
            <td>" . $pengendara['id_parkir'] . "</td>
            <td>" . $pengendara['No_Polisi'] . "</td>
            <td>" . $pengendara['Merk'] . "</td>
            <td>" . $pengendara['Jenis'] . "</td>
            <td>" . $pengendara['Blok'] . "</td>
            <td>" . $pengendara['Jam_Masuk'] . "</td>
            <td>" . $pengendara['Petugas'] . "</td>
        </tr>";
                        }

                        echo "
                    </tbody>
                </table>
            </div>
        </div>
    </div>";
                    }
                    ?>







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
                        <span aria-hidden="true">x</span>
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

    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="../../vendor/bootstrap/js/demo/datatables-demo.js"></script> -->

    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                searching: true, // Aktifkan fitur pencarian
                paging: true, // Nonaktifkan paging
                info: false, // Nonaktifkan informasi jumlah entri
                language: {
                    url: '../../vendor/datatables/Indonesian.json'
                    // url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#dataTable2').DataTable({
                searching: true, // Aktifkan fitur pencarian
                paging: true, // Nonaktifkan paging
                info: false, // Nonaktifkan informasi jumlah entri
                language: {
                    url: '../../vendor/datatables/Indonesian.json'
                    // url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#dataTable3').DataTable({
                searching: true, // Aktifkan fitur pencarian
                paging: true, // Nonaktifkan paging
                info: false, // Nonaktifkan informasi jumlah entri
                language: {
                    url: '../../vendor/datatables/Indonesian.json'
                    // url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#dataTable4').DataTable({
                searching: true, // Aktifkan fitur pencarian
                paging: true, // Nonaktifkan paging
                info: false, // Nonaktifkan informasi jumlah entri
                language: {
                    url: '../../vendor/datatables/Indonesian.json'
                    // url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#dataTable5').DataTable({
                searching: true, // Aktifkan fitur pencarian
                paging: true, // Nonaktifkan paging
                info: false, // Nonaktifkan informasi jumlah entri
                language: {
                    url: '../../vendor/datatables/Indonesian.json'
                    // url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#dataTable6').DataTable({
                searching: true, // Aktifkan fitur pencarian
                paging: true, // Nonaktifkan paging
                info: false, // Nonaktifkan informasi jumlah entri
                language: {
                    url: '../../vendor/datatables/Indonesian.json'
                    // url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
                },
            });
        });
    </script>

</body>

</html>