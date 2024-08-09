<?php

include '../../../config.php';
session_start();

if (isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

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
    } elseif (empty($password)) {
        // Jika ada field yang kosong, tampilkan pesan kesalahan
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Password Harus Diisi";
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
        // Insert data ke dalam tabel tbpengguna
        $query = "INSERT INTO tbpengguna (nama, username, password, hak_akses) VALUES ('$nama', '$username', '$hashedPass', 'Petugas')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['alertype_tbh'] = "Success";
            $_SESSION['alertmessage_tbh'] = "Petugas berhasil ditambahkan";
            header("Location: ../kelola_petugas.php");
            exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
        } else {
            $_SESSION['alertype1'] = "Danger";
            $_SESSION['alertmessage1'] = "Gagal melakukan pendaftaran. Silakan periksa kembali Nama, Username dan Password Anda.";
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }
}
