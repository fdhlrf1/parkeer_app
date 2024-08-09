<?php
include '../../../config.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM tbpengguna WHERE id=$id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['alertype_hps'] = "Success";
        $_SESSION['alertmessage_hps'] = "Petugas Berhasil dihapus";
        header("Location: ../kelola_petugas.php");
        exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
    } else {
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Gagal Menghapus.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
} else {
    die("akses dilarang...");
}
