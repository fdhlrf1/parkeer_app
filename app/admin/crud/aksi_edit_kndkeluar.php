<?php

include '../../../config.php';
session_start();

if (isset($_POST['kirim'])) {
    $kode_depan = $_POST['kode_depan'];
    $kode_angka = $_POST['kode_angka'];
    $kode_belakang = $_POST['kode_belakang'];

    $nolaporan = $_POST['No_Laporan'];
    $nopolisi = $_POST['nopolisi'];
    $merk = $_POST['merk'];
    $jenis = $_POST['jenis'];
    $blok = $_POST['blok'];
    $jammasuk = date('Y-m-d H:i:s', strtotime($_POST['jammasuk']));
    $jamkeluar = date('Y-m-d H:i:s', strtotime($_POST['jamkeluar']));
    $tagihan = $_POST['tagihan'];
    $petugas = $_POST['petugas'];

    // Menggabungkan nilai No Polisi
    $nopolisi = $kode_depan . ' ' . $kode_angka . ' ' . $kode_belakang;

    // Memeriksa apakah semua field diisi
    if (empty($nopolisi) || empty($merk) || empty($jenis) || empty($blok) || empty($jammasuk) || empty($jamkeluar) || empty($tagihan) || empty($petugas)) {
        // Jika ada field yang kosong, tampilkan pesan kesalahan
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Semua Kolom Harus Diisi!";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        $query = "UPDATE tbpengendara_keluar SET No_Polisi='$nopolisi', Merk='$merk', Jenis='$jenis', Blok='$blok', Jam_Masuk='$jammasuk', Jam_Keluar='$jamkeluar', Tagihan='$tagihan', Petugas='$petugas' WHERE No_Laporan='$nolaporan'";
        $hasil = mysqli_query($conn, $query);

        // Memeriksa apakah query berhasil dijalankan
        if ($hasil) {
            $_SESSION['alertype_edt'] = "Success";
            $_SESSION['alertmessage_edt'] = "Kendaraan Berhasil diubah";
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
