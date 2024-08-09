<?php
include '../config.php';
session_start();

// if (!isset($_SESSION['user'])) {
//     header("Location: ../index.php");
//     exit();
// }

// $user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Parkeer App</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/parkirfav.png">

    <!-- FONT-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap/css/my.css">

    <!-- <link rel="stylesheet" href="../css/boostrap 5/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="../css/boostrap-4-6/bootstrap.min.css"> -->


    <style>

    </style>

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <img id="logo" src="../assets/logo_huruf.png" alt="" width="150">
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                PETUGAS
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
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

                    <!-- ALERT DANGER GAGAL MELAKUKAN INSERT 2 -->
                    <?php
                    if (isset($_SESSION['alertype2']) && isset($_SESSION['alertmessage2'])) {
                        $alertype2 = $_SESSION['alertype2'];
                        $alertmessage2 = $_SESSION['alertmessage2'];
                    ?>
                        <div class="alert alert-<?= $alertype2 ?> alert-dismissible fade show alert-danger" role="alert">
                            <?= $alertmessage2 ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        unset($_SESSION['alertype2']);
                        unset($_SESSION['alertmessage2']);
                    }
                    ?>




                    <p class="hurufatas">Beranda</p>
                    <? //= $user['id'] 
                    ?>
                    <? //= $user['nama'] 
                    ?>
                    <? //= $user['username'] 
                    ?>
                    <? //= $user['hak_akses'] 
                    ?>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-5" style="border-radius: 10px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title hurufatas">Jumlah Motor</h5>
                                    <?php
                                    // Koneksi ke database
                                    include '../config.php';

                                    // Query untuk mengambil jumlah motor dari database
                                    $sql = "SELECT * FROM tbpengendara_masuk WHERE Jenis = 'Motor'";
                                    $query = mysqli_query($conn, $sql);

                                    // Menampilkan jumlah motor di dalam card
                                    $jumlah_motor = mysqli_num_rows($query);
                                    echo '<h1 style="font-size: 50px; color: black;">' . $jumlah_motor . '</h1>';
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-5" style="border-radius: 10px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title hurufatas">Jumlah Mobil</h5>
                                    <?php
                                    // Query untuk mengambil jumlah mobil dari database
                                    $sql = "SELECT * FROM tbpengendara_masuk WHERE Jenis = 'Mobil'";
                                    $query = mysqli_query($conn, $sql);

                                    // Menampilkan jumlah mobil di dalam card
                                    $jumlah_mobil = mysqli_num_rows($query);
                                    echo '<h1 style="font-size: 50px; color: black;">' . $jumlah_mobil . '</h1>';
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-5" style="border-radius: 10px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title hurufatas">Total Kendaraan</h5>
                                    <?php
                                    // Query untuk mengambil total kendaraan dari database
                                    $sql = "SELECT * FROM tbpengendara_masuk";
                                    $query = mysqli_query($conn, $sql);

                                    // Menampilkan total kendaraan di dalam card
                                    $total_kendaraan = mysqli_num_rows($query);
                                    echo '<h1 style="font-size: 50px; color: black;">' . $total_kendaraan . '</h1>';
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="mb-5"></div>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 mb-1">
                            <h6 class="m-0 font-weight-bold textjudultabel">Daftar Kendaraan Masuk</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <!-- <div class="d-flex justify-content-start mb-3">
                                    <label for="inputPassword6" class="col-form-label">Cari Kode Parkir :</label>

                                    <div class="form-group">
                                        <div class="col-auto">
                                            <input type="text" class="form-control" id="searchInput" placeholder="Masukkan Kode Parkir">
                                        </div>
                                    </div>
                                </div> -->

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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

                                    <tbody id="hasilPencarian">
                                        <?php
                                        // Data yang akan ditampilkan
                                        $sql = "SELECT * FROM tbpengendara_masuk";
                                        $query = mysqli_query($conn, $sql);

                                        while ($pengendara = mysqli_fetch_array($query)) {
                                            echo "<tr>";
                                            echo "<td>" . $pengendara['id_parkir'] . "</td>";
                                            echo "<td>" . $pengendara['No_Polisi'] . "</td>";
                                            echo "<td>" . $pengendara['Merk'] . "</td>";
                                            echo "<td>" . $pengendara['Jenis'] . "</td>";
                                            echo "<td>" . $pengendara['Blok'] . "</td>";
                                            echo "<td>" . $pengendara['Jam_Masuk'] . "</td>";
                                            echo "<td>" . $pengendara['Petugas'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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