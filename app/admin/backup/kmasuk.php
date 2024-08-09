<?php
// include '../../config.php';
// session_start();

// // Ambil data dari database
// $sql = "SELECT * FROM tbpengendara_masuk";
// $result = mysqli_query($conn, $sql);

// $finaldata = array();

// while ($data = mysqli_fetch_assoc($result)) {
//     $finaldata[] = $data;
// }

// // Cek jika tombol export diklik
// if (isset($_POST['export'])) {
//     // Tentukan nama file
//     $filename = "DataKndMasuk-" . date('Y-m-d') . ".xls";

//     // Set header untuk file Excel
//     header("Content-Type: application/vnd.ms-excel");
//     header("Content-Disposition: attachment; filename=\"$filename\"");

//     // Tulis data ke file Excel
//     $firstrow = false;
//     foreach ($finaldata as $data) {
//         if (!$firstrow) {
//             echo implode("\t", array_keys($data)) . "\n";
//             $firstrow = true;
//         }

//         echo implode("\t", array_values($data)) . "\n";
//     }

//     exit;
// }



?>


<?php
include '../../config.php';
session_start();

// Ambil tanggal dari parameter GET
$tanggal = $_GET['tanggal'] ?? '';

// Query untuk mengambil data kendaraan masuk berdasarkan tanggal
if (!empty($tanggal)) {
    $sql = "SELECT * FROM tbpengendara_masuk WHERE DATE(Jam_Masuk) = '$tanggal'";
    $result = mysqli_query($conn, $sql);

    $finaldata = array();

    while ($data = mysqli_fetch_assoc($result)) {
        $finaldata[] = $data;
    }
} else {
    // Jika tidak ada tanggal yang diberikan, ambil semua data
    $sql = "SELECT * FROM tbpengendara_masuk";
    $result = mysqli_query($conn, $sql);

    $finaldata = array();

    while ($data = mysqli_fetch_assoc($result)) {
        $finaldata[] = $data;
    }
}

// Cek jika tombol export diklik
if (isset($_POST['export'])) {
    // Tentukan nama file
    $filename = "DataKndMasuk-" . date('Y-m-d') . ".xls";

    // Set header untuk file Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    // Tulis data ke file Excel
    $firstrow = false;
    foreach ($finaldata as $data) {
        if (!$firstrow) {
            echo implode("\t", array_keys($data)) . "\n";
            $firstrow = true;
        }

        echo implode("\t", array_values($data)) . "\n";
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendaraan Masuk - Parkeer App</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../assets/parkirfav.png">

    <!-- FONT-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- CSS-->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../vendor/bootstrap/css/my.css">

    <!-- Custom styles for this page -->
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="../../vendor/bootstrap/js/xlsx.full.min.js"></script>
    <script src="../../vendor/bootstrap/js/FileSaver.js"></script>

    <style>
        .btn-success:hover {
            border-color: #0988d0;

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
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MANAJEMEN
            </div>

            <!-- Nav Item - Pages Collapse Menu -->


            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
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
                <a class="nav-link" href="../../index.php" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Log Out</span></a>
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
                                    <?= $_SESSION['nama']; ?>
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
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div class="container ml-2">
                    <!-- ALERT SUCCESS Pengendara Berhasil Keluar -->
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


                    <p class="hurufatas">Laporan</p>

                    <div class="mb-4"></div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">



                            <h6 class="m-0 font-weight-bold textjudultabel">Daftar Kendaraan Masuk</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <div class="d-flex justify-content-between">

                                    <div class="d-flex justify-content-start mb-3">
                                        <label for="inputPassword6" class="col-form-label">Cari Kode Parkir :</label>

                                        <div class="form-group">
                                            <div class="col-auto">
                                                <input type="text" class="form-control" id="searchInput" placeholder="Masukkan Kode Parkir">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mb-3">
                                        <label for="inputTanggal" class="col-form-label">Cari berdasarkan Tanggal Masuk :</label>
                                        <div class="form-group">
                                            <div class="col-auto">
                                                <input type="date" class="form-control" id="inputTanggal" name="tanggal">
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <script>
                                    document.getElementById('inputTanggal').addEventListener('change', function() {
                                        var tanggal = this.value;
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('GET', 'sortir_data_masuk.php?tanggal=' + tanggal, true);
                                        xhr.onload = function() {
                                            if (this.status == 200) {
                                                document.getElementById('hasilPencarian').innerHTML = this.responseText;
                                            }
                                        }
                                        xhr.send();
                                    });
                                </script>


                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kode Parkir</th>
                                            <th>No Polisi</th>
                                            <th>Merk</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Blok</th>
                                            <th>Jam Masuk</th>
                                        </tr>
                                    </thead>

                                    <tbody id="hasilPencarian">
                                        <?php

                                        foreach ($finaldata as $data) { ?>
                                            <tr>
                                                <td><?php echo $data['id_parkir']; ?></td>
                                                <td><?php echo $data['No_Polisi']; ?></td>
                                                <td><?php echo $data['Merk']; ?></td>
                                                <td><?php echo $data['Jenis']; ?></td>
                                                <td><?php echo $data['Blok']; ?></td>
                                                <td><?php echo $data['Jam_Masuk']; ?></td>
                                            </tr>


                                        <?php } ?>
                                    </tbody>
                                </table>

                                <form method="post">
                                    <input type="submit" class="btn btn-success" name="export" value="Export to Excel">
                                </form>


                                <script>
                                    // Fungsi untuk melakukan pencarian berdasarkan id_parkir
                                    document.getElementById('searchInput').addEventListener('input', function() {
                                        let keyword = this.value.toLowerCase(); // Ambil nilai input dan ubah menjadi lowercase
                                        let rows = document.querySelectorAll('#dataTable tbody tr'); // Ambil semua baris pada tabel

                                        rows.forEach(row => {
                                            let idParkir = row.cells[0].textContent.toLowerCase(); // Ambil nilai id_parkir dari setiap baris dan ubah menjadi lowercase
                                            if (idParkir.indexOf(keyword) > -1) { // Periksa apakah keyword ada dalam id_parkir
                                                row.style.display = ''; // Tampilkan baris jika keyword cocok
                                            } else {
                                                row.style.display = 'none'; // Sembunyikan baris jika keyword tidak cocok
                                            }
                                        });
                                    });
                                </script>

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
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Anda akan keluar dari sesi ini. Apakah Anda yakin ingin melanjutkan?</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                <a class="btn btn-primarykeluar" href="../../index.php">Logout</a>
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