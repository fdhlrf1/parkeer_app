<?php

include '../../../config.php';
session_start();

if (isset($_POST['kirim'])) {
    $id_blok = $_POST['id_blok'];
    // $jenis = $_POST['jenis'];
    $Blok = $_POST['blok'];
    $Total_Tempat = $_POST['totaltempat'];

    if (empty($Blok)) {
        // Jika ada field yang kosong, tampilkan pesan kesalahan
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Blok Harus Diisi";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        $query = "UPDATE tbblok_parkir SET Blok='$Blok',Total_Tempat='$Total_Tempat' WHERE id_blok = '$id_blok'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['alertype_edt'] = "Success";
            $_SESSION['alertmessage_edt'] = "Blok Berhasil diedit";
            header("Location: ../kelola_blok.php");
            exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
        } else {
            $_SESSION['alertype1'] = "Danger";
            $_SESSION['alertmessage1'] = "Blok gagal diedit";
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }
}
