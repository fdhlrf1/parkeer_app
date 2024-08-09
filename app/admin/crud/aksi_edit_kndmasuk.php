<?php

include '../../../config.php';
session_start();

if (isset($_POST['kirim'])) {
    $kode_depan = $_POST['kode_depan'];
    $kode_angka = $_POST['kode_angka'];
    $kode_belakang = $_POST['kode_belakang'];

    $id_parkir = $_POST['id_parkir'];
    $merk = $_POST['merk'];
    $jenis = $_POST['jenis'];
    $blok = $_POST['blok'];
    $blok_sebelumnya = $_POST['blok_sebelumnya'];
    $jammasuk = date('Y-m-d H:i:s', strtotime($_POST['jammasuk']));
    $petugas = $_POST['petugas'];

    // Menggabungkan nilai No Polisi
    $nopolisi = $kode_depan . ' ' . $kode_angka . ' ' . $kode_belakang;

    // Memeriksa apakah semua field diisi
    if (empty($nopolisi) || empty($merk) || empty($jenis) || empty($blok) || empty($jammasuk) || empty($petugas)) {
        // Jika ada field yang kosong, tampilkan pesan kesalahan
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Semua Kolom Harus Diisi!";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        $query = "UPDATE tbpengendara_masuk SET No_Polisi='$nopolisi', Merk='$merk', Jenis='$jenis', Blok='$blok', Jam_Masuk='$jammasuk', Petugas='$petugas' WHERE id_parkir='$id_parkir'";
        $hasil = mysqli_query($conn, $query);

        // memperbarui Tabel Blok Baru
        $query_update_terisi = "UPDATE tbblok_parkir SET Terisi = Terisi + 1 WHERE Blok = '$blok'";
        $result_terisi = mysqli_query($conn, $query_update_terisi);

        $query_update_total = "UPDATE tbblok_parkir SET Total_Tempat = Total_Tempat - 1 WHERE Blok = '$blok'";
        $result_total = mysqli_query($conn, $query_update_total);

        // memperbarui Tabel Blok Sebelumnya
        $query_update_terisiB = "UPDATE tbblok_parkir SET Terisi = Terisi - 1 WHERE Blok = '$blok_sebelumnya'";
        $result_terisiB = mysqli_query($conn, $query_update_terisiB);

        $query_update_totalB = "UPDATE tbblok_parkir SET Total_Tempat = Total_Tempat + 1 WHERE Blok = '$blok_sebelumnya'";
        $result_totalB = mysqli_query($conn, $query_update_totalB);

        // Memeriksa apakah query berhasil dijalankan
        if ($hasil && $result_terisi && $result_total && $result_terisiB && $result_totalB) {
            $_SESSION['alertype_edt'] = "Success";
            $_SESSION['alertmessage_edt'] = "Kendaraan berhasil Diubah";
            // Kembali ke halaman dashboard
            header("Location: ../kelola_kendaraan.php");
            exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
        } else {
            $_SESSION['alertype1'] = "Danger";
            $_SESSION['alertmessage1'] = "Gagal Melakukan Insert";
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }
}
