<?php
include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Parkeer App</title>
    <!-- <link rel="stylesheet" href="css/boostrap 5/bootstrap.css" /> -->
    <!-- <link rel="stylesheet" href="css/boostrap-4-6/bootstrap.css" /> -->

    <!-- FONT-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/parkirfav.png">
    <style>
        .btn-primary {
            background-color: #07689F;
        }

        .btn-primary:hover {
            background-color: #055582;
        }

        span {
            color: #07689F;
        }

        .ket {
            color: #000000;

        }

        .parkeer {
            color: #000000;
            font-size: 22px;
        }

        .buat {
            color: #055582;

        }

        .admin {
            color: red;
        }

        .buat:hover {
            color: #07689F;

        }
    </style>
</head>

<body>

    <section class="vh-100" style="background-image: linear-gradient(to bottom, #0988D0, #05486E);">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form method="post" action="aksi_login.php">
                                <h3 class="mb-5"><img src="assets/logo1.png" alt="" srcset=""></h3>

                                <!-- ALERT DANGER USERNAME ATAU PASSWORD SALAH 2 -->
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


                                <!-- ALERT SUCCESS SILAHKAN LOGIN -->
                                <?php
                                if (isset($_SESSION['alertypelog']) && isset($_SESSION['alertmessagelog'])) {
                                    $alertypelog = $_SESSION['alertypelog'];
                                    $alertmessagelog = $_SESSION['alertmessagelog'];
                                ?>
                                    <div class="alert alert-<?= $alertypelog ?> alert-dismissible fade show alert-success" role="alert">
                                        <?= $alertmessagelog ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php
                                    unset($_SESSION['alertypelog']);
                                    unset($_SESSION['alertmessagelog']);
                                }
                                ?>

                                <!-- ALERT DANGER GAGAL DAFTAR 1 -->
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
                                <div class="form-outline mb-4">
                                    <input type="text" id="username" class="form-control form-control-lg" placeholder="Username" name="username" />
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" id="password" class="form-control form-control-lg" placeholder="Password" name="password" />
                                </div>

                                <div class="d-grid gap-2 mb-5">
                                    <div class="d-flex justify-content-center"></div>
                                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="login">LOGIN</button>

                                </div>
                            </form>

                            <p class="text-center parkeer mb-1">Created by <span>PARKEER</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skrip JavaScript untuk menutup alert saat tombol close ditekan -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var closeButtons = document.querySelectorAll('.alert .close');
            closeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var alert = this.parentElement;
                    alert.classList.remove('show');
                    setTimeout(function() {
                        alert.style.display = 'none';
                    }, 500); // waktu penundaan sebelum alert benar-benar dihapus
                });
            });
        });
    </script>

</body>

</html>