<?php
include '../config.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkir Masuk - Parkeer App</title>

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
                    <!-- ALERT DANGER SEMUA KOLOM HRS DIISI 1 -->
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

                    <!-- ALERT DANGER WARNING PENUH -->
                    <?php
                    if (isset($_SESSION['alertypeblok']) && isset($_SESSION['alertmessageblok'])) {
                        $alertypeblok = $_SESSION['alertypeblok'];
                        $alertmessageblok = $_SESSION['alertmessageblok'];
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= $alertmessageblok ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        unset($_SESSION['alertypeblok']);
                        unset($_SESSION['alertmessageblok']);
                    }
                    ?>

                    <p class="hurufatas">Parkir</p>

                    <div class="mb-4"></div>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold textjudultabel">Parkir Masuk</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="aksi_masuk.php" method="post">

                                    <p class="text-center" style="font-size:30px; font-weight:500; color:#707070;">
                                        INPUT PENGENDARA
                                    </p>

                                    <div class="ml-5 mr-5">

                                        <label for="nopolisi" class="form-label">No Polisi</label>
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="text" name="kode_depan" class="form-control mb-1" placeholder="Kode Wilayah" maxlength="2" pattern="[A-Z]{1,2}" title="Harap masukkan huruf besar saja" oninput="this.value = this.value.toUpperCase();" required>
                                            </div>
                                            <div class="col">
                                                <input type="number" name="kode_angka" class="form-control mb-1" placeholder="Nomor Polisi" oninput="this.value = this.value.slice(0, 4)" min="1" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="kode_belakang" class="form-control mb-1" placeholder="Wilayah & Golongan Kendaraan" maxlength="3" pattern="[A-Z]{1,3}" title="Harap masukkan huruf besar saja" oninput="this.value = this.value.toUpperCase();" required>
                                            </div>
                                        </div>


                                        <label for="Jenis" class="form-label">Jenis Kendaraan</label>
                                        <select name="jenis" class="form-control mb-1" onchange="updateMerkOptions()" id="jenis">
                                            <option>Motor</option>
                                            <option>Mobil</option>
                                        </select>

                                        <label for="Merk" class="form-label">Merk</label>
                                        <select name="merk" id="merk" class="form-control mb-1">
                                            <!-- Options will be dynamically updated -->
                                        </select>

                                        <?php
                                        include("../config.php");

                                        $query = "SELECT Blok FROM tbblok_parkir";
                                        $result = mysqli_query($conn, $query);

                                        if (!$result) {
                                            die("Query failed: " . mysqli_error($conn));
                                        }
                                        ?>

                                        <label for="nama" class="form-label">Blok</label>
                                        <select name="blok" class="form-control mb-1">
                                            <?php
                                            // Loop through the result and create an option for each block
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['Blok']}'>{$row['Blok']}</option>";
                                            }
                                            ?>
                                        </select>

                                        <input type="hidden" name="petugas" id="" value="<?= $_SESSION['petugas']; ?>">

                                        <div class="mb-4"></div>

                                        <input type="submit" value="Submit" name="kirim" class="btn btnsubmit">
                                    </div>
                                </form>


                                <script>
                                    function updateMerkOptions() {
                                        console.log('updateMerkOptions dipanggil'); // Debugging statement
                                        const merkSelect = document.getElementById('merk');
                                        const jenisSelect = document.getElementById('jenis');

                                        if (!merkSelect || !jenisSelect) {
                                            console.error('Elemen merk atau jenis tidak ditemukan');
                                            return;
                                        }

                                        const jenisValue = jenisSelect.value;

                                        // Clear existing options
                                        merkSelect.innerHTML = '';

                                        let options = [];

                                        if (jenisValue === 'Motor') {
                                            options = ['Honda', 'Yamaha', 'Suzuki', 'Kawasaki', 'Vespa', 'Merk tidak diketahui'];
                                        } else if (jenisValue === 'Mobil') {
                                            options = ['Toyota', 'Honda', 'Ford', 'BMW', 'Mercedes', 'Nissan', 'Datsun', 'Daihatsu', 'Suzuki', 'Jeep', 'Isuzu', 'Mazda', 'Hyundai', 'Mitsubishi', 'Chevrolet', 'KIA', 'Merk tidak diketahui'];
                                        }

                                        options.forEach(function(option) {
                                            console.log('Menambahkan opsi:', option); // Debugging statement
                                            const newOption = document.createElement('option');
                                            newOption.value = option;
                                            newOption.text = option;
                                            merkSelect.appendChild(newOption);
                                        });
                                    }

                                    // Initialize merk options on page load
                                    document.addEventListener('DOMContentLoaded', function() {
                                        console.log('DOM telah dimuat sepenuhnya'); // Debugging statement
                                        updateMerkOptions();
                                    });

                                    document.querySelector('form').addEventListener('submit', function(e) {
                                        const kodeDepan = document.querySelector('input[name="kode_depan"]').value;
                                        const kodeBelakang = document.querySelector('input[name="kode_belakang"]').value;
                                        const regex = /^[A-Z]+$/;

                                        if (!regex.test(kodeDepan) || !regex.test(kodeBelakang)) {
                                            e.preventDefault();
                                            alert('Kode depan dan kode belakang harus berupa huruf besar!');
                                        }
                                    });
                                </script>

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