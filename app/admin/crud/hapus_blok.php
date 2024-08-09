<?php
include '../../../config.php';
session_start();

if (isset($_GET['id_blok'])) {
    $id_blok = $_GET['id_blok'];

    $query = "DELETE FROM tbblok_parkir WHERE id_blok=$id_blok";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['alertype_hps'] = "Success";
        $_SESSION['alertmessage_hps'] = "Blok Berhasil dihapus";
        header("Location: ../kelola_blok.php");
        exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
    } else {
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Gagal Menghapus.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
} else {
    die("akses dilarang...");
}
