<?php
include "../../../config.php";
session_start();

if (isset($_POST['kirim'])) {
    $Blok = $_POST['blok'];
    $Total_Tempat = $_POST['totaltempat'];

    // Query untuk memeriksa apakah nama blok sudah ada dalam database
    $query_check = "SELECT * FROM tbblok_parkir WHERE Blok = '$Blok'";
    $result_check = mysqli_query($conn, $query_check);

    // Jika hasil query tidak kosong, berarti nama blok sudah ada
    if (mysqli_num_rows($result_check) > 0) {
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Blok dengan nama yang sama sudah ada!";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        // Jika nama blok belum ada, lakukan penambahan data blok baru
        $query_tambah = "INSERT INTO tbblok_parkir (Blok, Total_Tempat) VALUES ('$Blok', '$Total_Tempat')";
        $result_tambah = mysqli_query($conn, $query_tambah);

        if ($result_tambah) {
            $_SESSION['alertype_tbh'] = "Success";
            $_SESSION['alertmessage_tbh'] = "Blok berhasil ditambahkan!";
            header("Location: ../kelola_blok.php");
            exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
        } else {
            $_SESSION['alertype1'] = "Danger";
            $_SESSION['alertmessage1'] = "Gagal menambahkan blok!";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
    }
}
