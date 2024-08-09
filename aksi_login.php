<?php
// menghubungkan ke database
include 'config.php';
session_start();

if (isset($_POST['login'])) {
    // menerima data yang di inputkan pada form login dan melakukan sanitasi
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // membuat query login berdasarkan username
    $query = "SELECT * FROM tbpengguna WHERE username='$username'";
    $login = mysqli_query($conn, $query);

    $cek = mysqli_num_rows($login);

    // cek username ada di table database atau tidak
    if ($cek == 1) {
        // Ambil data user dari hasil query
        $data = mysqli_fetch_assoc($login);
        // cek password benar 
        if (password_verify($password, $data['password'])) {

            //nama session = user
            // $_SESSION['user'] = $data;


            if ($data['hak_akses'] == 'Admin') {
                $_SESSION['alertype'] = "Success";
                $_SESSION['alertmessage'] = "Halo Selamat Datang <b>" . $data['nama'] . "</b>,  Hak Akses : <b>" . $data['hak_akses'] . "</b>";
                //nama session = admin
                $_SESSION['admin'] = $data['nama'];
                header("Location: app/admin/dashboard.php");
                exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
            } else if ($data['hak_akses'] == 'Petugas') {
                $_SESSION['alertype'] = "Success";
                $_SESSION['alertmessage'] = "Halo Selamat Datang <b>" . $data['nama'] . "</b>,  Hak Akses : <b>" . $data['hak_akses'] . "</b>";
                //nama session = petugas
                $_SESSION['petugas'] = $data['nama'];
                header("Location: app/dashboard.php");
                exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
            } else {
                echo "akses tidak ada";
            }
        } else {
            $_SESSION['alertype2'] = "Danger";
            $_SESSION['alertmessage2'] = "Password Salah";
        }
    } else {
        $_SESSION['alertype2'] = "Danger";
        $_SESSION['alertmessage2'] = "Username tidak ditemukan";
    }

    // Redirect kembali ke halaman login setelah menetapkan pesan alert
    header("Location: index.php");
    exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
}
