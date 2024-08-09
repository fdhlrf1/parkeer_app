<?php

include '../../../config.php';
session_start();

if (isset($_POST['kirim'])) {
    $id_tarif = $_POST['id_tarif'];
    // $jenis = $_POST['jenis'];
    $tarif = $_POST['tarif'];

    if (empty($tarif)) {
        // Jika ada field yang kosong, tampilkan pesan kesalahan
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Tarif Harus Diisi";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        $query = "UPDATE tbtarif_parkir SET tarif='$tarif' WHERE id_tarif=$id_tarif";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['alertype_edt'] = "Success";
            $_SESSION['alertmessage_edt'] = "Tarif Berhasil diedit";
            header("Location: ../kelola_tarif.php");
            exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
        } else {
            $_SESSION['alertype1'] = "Danger";
            $_SESSION['alertmessage1'] = "Tarif gagal diedit";
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }
}
