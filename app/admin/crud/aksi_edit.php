
<?php

include '../../../config.php';
session_start();

if (isset($_POST['kirim'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah input password baru tidak kosong
    if (!empty($password)) {
        // Jika tidak kosong, hash password baru
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
    } else {
        // Jika kosong, ambil password yang sudah ada dari database
        $query = "SELECT password FROM tbpengguna WHERE id=$id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $hashedPass = $row['password'];
    }


    if (empty($nama)) {
        // Jika ada field yang kosong, tampilkan pesan kesalahan
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Nama Harus Diisi";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } elseif (empty($username)) {
        // Jika ada field yang kosong, tampilkan pesan kesalahan
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Username Harus Diisi";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } elseif (strpos($username, ' ') !== false) {
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Username tidak boleh mengandung spasi.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } elseif (strtolower($username) !== $username) {
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Username hanya boleh mengandung huruf kecil.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {

        $query = "UPDATE tbpengguna SET nama='$nama', username='$username', password='$hashedPass' WHERE id=$id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['alertype_edt'] = "Success";
            $_SESSION['alertmessage_edt'] = "Petugas Berhasil diedit";
            header("Location: ../kelola_petugas.php");
            exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
        } else {
            $_SESSION['alertype1'] = "Danger";
            $_SESSION['alertmessage1'] = "Gagal melakukan pendaftaran. Silakan periksa kembali Nama, Username dan Password Anda.";
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }
}
