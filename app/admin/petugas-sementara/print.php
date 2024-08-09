<?php
include '../../../config.php';
session_start();


$id_parkir = $_GET['id_parkir'];

$sql = "SELECT * FROM tbpengendara_masuk WHERE id_parkir='$id_parkir'";
$query = mysqli_query($conn, $sql);
$pengendara = mysqli_fetch_assoc($query);


if (isset($_POST['btn_print'])) {
    echo "<script>document.location.href='../dashboard.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk - Parkeer App</title>


    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../../assets/parkirfav.png">

    <!-- <link rel="stylesheet" type="text/css" href="../../../vendor/bootstrap/css/bootstrap.min.css"> -->
    <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="../../../vendor/bootstrap/css/plugins/animate.min.css" />
    <!-- <link rel="stylesheet" type="text/css" href="../../../vendor/bootstrap/css/plugins/simple-line-icons.css" /> -->

    <!-- FONT-->
    <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- CSS-->
    <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../vendor/bootstrap/css/my.css">
    <!-- <link href="../../../vendor/bootstrap/css/style-print.css" rel="stylesheet"> -->

    <style>
        .btn-success {
            width: 20%;
            background-color: #07689f;
            border-color: #07689f;

        }

        .btn-success:active {
            width: 20%;
            background-color: #2280c2;
            border-color: #2280c2;

        }

        .btn-success:focus {
            width: 20%;
            background-color: #2280c2;
            border-color: #2280c2;

        }

        .btn-success:hover {
            width: 20%;
            background-color: #2280c2;
            border-color: #2280c2;

        }

        table {
            width: 200px;
            /* Lebar tabel disesuaikan */
            border-collapse: collapse;
        }

        th,
        td {
            padding: 3px;
            text-align: left;
            font-family: Arial, sans-serif;
            font-size: 11px;
            /* Ukuran font lebih kecil */
        }

        th {
            background-color: #f2f2f2;
        }

        .center {
            text-align: center;
            font-family: Arial, sans-serif;
            font-weight: normal;
        }

        .title {
            font-size: 13px;
            font-family: Arial, sans-serif;
            /* Ukuran font lebih besar */
            font-weight: bold;
        }

        .separator {
            border-bottom: 1px solid #ccc;
            margin: 5px 0;
        }

        .center-form {
            margin: 0 auto;
            /* Membuat form menjadi terpusat */
            width: 100%;
            /* Sesuaikan lebar form sesuai kebutuhan */
        }
    </style>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <img id="logo" src="../../../assets/logo_huruf.png" alt="" width="150">
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                ADMIN
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../dashboard.php">
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-parking"></i>
                    <span>Parkir</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="parkir_masuk.php">Parkir Masuk</a>
                        <a class="collapse-item" href="parkir_keluar.php">Parkir Keluar</a>
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
                        <a class="collapse-item" href="../kelola_petugas.php">Kelola Petugas</a>
                        <a class="collapse-item" href="../kelola_kendaraan.php">Kelola Kendaraan</a>
                        <a class="collapse-item" href="../kelola_tarif.php">Kelola Tarif</a>
                        <a class="collapse-item" href="../kelola_laporan.php">Kelola Laporan</a>
                        <a class="collapse-item" href="../kelola_blok.php">Kelola Blok</a>
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
                        <a class="collapse-item" href="../kendaraan_masuk.php">Kendaraan Masuk</a>
                        <a class="collapse-item" href="../kendaraan_keluar.php">Kendaraan Keluar</a>
                        <a class="collapse-item" href="../rekapan_masuk.php">Rekapan Masuk</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="../../../index.php" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Beranda</span></a>
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
                    <form action="../search.php" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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

                                <img class="img-profile rounded-circle" src="../../../assets/user1.png">
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
                    <p class="hurufatas">Print Karcis</p>
                    <div class="row">
                        <div class="col-md-4">

                            <form method="post">
                                <div class="page-404 animated flipInX print-area">
                                    <div id="print-karcis" class="print-area center-form" style="color : #2280c2;">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th colspan="2" class="center title" style="font-weight: 800;">TIKET PARKIR</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" class="center" style="font-weight: 700;">PASAR MODERN JASINGA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="separator"></td>
                                                </tr>
                                                <tr>
                                                    <td>Plat</td>
                                                    <td>: <?= $pengendara['No_Polisi'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Merk</td>
                                                    <td>: <?= $pengendara['Merk'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Jenis</td>
                                                    <td>: <?= $pengendara['Jenis'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Blok</td>
                                                    <td>: <?= $pengendara['Blok'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Jam-Masuk</td>
                                                    <td>: <?= $pengendara['Jam_Masuk'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Petugas</td>
                                                    <td>: <?= $_SESSION['admin'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="separator"></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" class="center" style="font-weight: 700;">Terimakasih</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="submit" onclick="javascript:printDiv('print-karcis');" class="btn btn-outline btn-success no-print mt-3" name="btn_print">

                                                            <i class="fa fa-print" aria-hidden="true"></i>

                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </form>


                            <textarea id="printing-css" style="display:none; size:50mm">html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,em,img,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,footer,header,output,ruby,section,summary,time,mark{margin:10;padding:0;border:0;font-size:100%;font:inherit;vertical-align:center;text-align:center;}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1;}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:before,blockquote:after,q:before,q:after{content:'';content:none}table{border-collapse:collapse;border-spacing:0}body{font:normal normal .8125em/1.4 Arial,Sans-Serif;background-color:#f1f1f1;color:#333}strong,b{font-weight:bold}cite,em,i{font-style:italic}a{text-decoration:none}a:hover{text-decoration:underline}a img{border:none}abbr,acronym{border-bottom:1px dotted;cursor:help}sup,sub{vertical-align:baseline;position:relative;top:-.4em;font-size:86%}sub{top:.4em}small{font-size:86%}kbd{font-size:80%;border:1px solid #999;padding:2px 5px;border-bottom-width:2px;border-radius:3px}mark{background-color:#ffce00;color:black}p,blockquote,pre,table,figure,hr,form,ol,ul,dl{margin:1.5em 0}hr{height:1px;border:none;background-color:#666}h1,h2,h3,h4,h5,h6{font-weight:bold;line-height:normal;margin:1.5em 0 0}h1{font-size:200%}h2{font-size:180%}h3{font-size:160%}h4{font-size:140%}h5{font-size:120%}h6{font-size:100%}ol,ul,dl{margin-left:3em}ol{list-style:decimal outside}ul{list-style:disc outside}li{margin:.5em 0}dt{font-weight:bold}dd{margin:0 0 .5em 2em}input,button,select,textarea{font:inherit;font-size:100%;line-height:normal;vertical-align:baseline}textarea{display:block;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}pre,code{font-family:"Courier New",Courier,Monospace;color:inherit}pre{white-space:pre;word-wrap:normal;overflow:auto}blockquote{margin-left:2em;margin-right:2em;border-left:4px solid #ccc;padding-left:1em;font-style:italic}table[border="1"] th,table[border="1"] td,table[border="1"] caption{border:1px solid;padding:.5em 1em;text-align:left;vertical-align:top}th{font-weight:bold}table[border="1"] caption{border:none;font-style:italic}.no-print{display:none}</textarea>
                            <iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
                            <script>
                                function printDiv(elementId) {
                                    var a = document.getElementById('printing-css').value;
                                    var b = document.getElementById(elementId).innerHTML;
                                    window.frames["print_frame"].document.title = document.title;
                                    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
                                    window.frames["print_frame"].window.focus();
                                    window.frames["print_frame"].window.print();
                                }
                            </script>



                        </div>

                    </div>
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
                    <a class="btn btn-primarykeluar" href="../../../index.php">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../../vendor/bootstrap/js/sb-admin-2.min.js"></script>


</body>



</html>