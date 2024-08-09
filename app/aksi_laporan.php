<?php
include("../config.php");
session_start();

if (isset($_POST['kirim'])) {

    //ngambil data dari FORM AKSI TAGIHAN
    $id_parkir = $_POST['id_parkir'];
    $nopolisi = $_POST['nopolisi'];
    $merk = $_POST['merk'];
    $jenis = $_POST['jenis'];
    $blok = $_POST['blok'];
    $jammasuk = date('Y-m-d H:i:s', strtotime($_POST['jammasuk']));
    $jamkeluar = date('Y-m-d H:i:s', strtotime($_POST['jamkeluar']));
    $tarif = $_POST['tarif'];
    $tagihan = $_POST['tagihan'];
    $petugas = $_POST['petugas'];

    // Query untuk mendapatkan maksimum nolaporan
    $query = "SELECT max(cast(substring(No_Laporan, 4) as signed)) as maxKode FROM tbpengendara_keluar";
    $hasil = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($hasil);

    $maxKode = $data['maxKode'];

    $nourut = (int) $maxKode;

    $nourut++;
    $char = 'RPT';
    $nolaporan = $char . sprintf("%03s", $nourut);

    // buat query update
    $sql = "INSERT INTO tbpengendara_keluar VALUES ('$nolaporan','$id_parkir','$nopolisi','$merk','$jenis','$blok','$jammasuk','$jamkeluar','$tarif','$tagihan','$petugas')";
    $query = mysqli_query($conn, $sql);

    $sql_hapus = "DELETE FROM tbpengendara_masuk WHERE id_parkir='$id_parkir'";
    $query_hapus = mysqli_query($conn, $sql_hapus);

    // Perbarui jumlah tempat terisi dalam tabel tbblok_parkir
    $query_update_terisi = "UPDATE tbblok_parkir SET Terisi = Terisi - 1 WHERE Blok = '$blok'";
    $result_terisi = mysqli_query($conn, $query_update_terisi);

    // Perbarui jumlah total tempat dalam tabel tbblok_parkir
    $query_update_total = "UPDATE tbblok_parkir SET Total_Tempat = Total_Tempat + 1 WHERE Blok = '$blok'";
    $result_total = mysqli_query($conn, $query_update_total);

    // apakah query update berhasil?
    if ($query && $query_hapus && $result_terisi && $result_total) {
        // Jika berhasil, set alert success
        $_SESSION['alertype'] = "Success";
        $_SESSION['alertmessage'] = "Data Berhasil Disimpan";
        header("Location: kendaraan_keluar.php");
    } else {
        // Jika gagal, set alert danger
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Gagal Menyimpan Perubahan";
        // kembali ke halaman sebelumnya
        header("Location: kendaraan_keluar.php");
    }
}
