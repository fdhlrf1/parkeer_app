<?php

include("../config.php");

session_start();

date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['kirim'])) {
    // Mengambil nilai dari form
    $kode_depan = $_POST['kode_depan'];
    $kode_angka = $_POST['kode_angka'];
    $kode_belakang = $_POST['kode_belakang'];
    $merk = $_POST['merk'];
    $jenis = $_POST['jenis'];
    $blok = $_POST['blok'];
    // $jammasuk = date('Y-m-d H:i:s', strtotime($_POST['jammasuk']));
    $jammasuk = date('Y-m-d H:i:s');
    $petugas = $_POST['petugas'];

    // Menggabungkan nilai No Polisi
    $nopolisi = $kode_depan . ' ' . $kode_angka . ' ' . $kode_belakang;

    // Memeriksa apakah semua field diisi
    if (empty($kode_depan) || empty($kode_angka) || empty($kode_belakang) || empty($merk) || empty($jenis) || empty($blok) || empty($jammasuk) || empty($petugas)) {
        // Jika ada field yang kosong, tampilkan pesan kesalahan
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Semua Kolom Harus Diisi!";
        header("Location: parkir_masuk.php");
    } else {
        // Query untuk mendapatkan maksimum id_parkir
        $query = "SELECT max(cast(substring(id_parkir, 4) as signed)) as maxKode FROM tbpengendara_masuk";
        $hasil = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($hasil);

        $maxKode = $data['maxKode'];

        $nourut = (int) $maxKode;

        $nourut++;
        $char = 'PRK';
        $id_parkir = $char . sprintf("%03s", $nourut);

        // Memeriksa apakah total tempat terisi sudah mencapai kapasitas penuh
        $query_check_full = "SELECT Total_Tempat, Terisi FROM tbblok_parkir WHERE Blok = '$blok'";
        $result_check_full = mysqli_query($conn, $query_check_full);

        $row_check_full = mysqli_fetch_assoc($result_check_full);

        if ($row_check_full['Total_Tempat'] <= 0) {
            // Blok parkir sudah penuh, berikan pemberitahuan
            $_SESSION['alertypeblok'] = "Warning";
            $_SESSION['alertmessageblok'] = "Blok Parkir $blok sudah penuh!";
            header("Location: {$_SERVER['HTTP_REFERER']}");
        } else {
            // Query untuk menyimpan data tbpengendara_masuk
            $query_masuk = "INSERT INTO tbpengendara_masuk VALUES('$id_parkir','$nopolisi', '$merk', '$jenis', '$blok', '$jammasuk', '$petugas')";
            $sql = mysqli_query($conn, $query_masuk);

            // Perbarui jumlah tempat terisi dalam tabel tbblok_parkir
            $query_update_terisi = "UPDATE tbblok_parkir SET Terisi = Terisi + 1 WHERE Blok = '$blok'";
            $result_terisi = mysqli_query($conn, $query_update_terisi);

            // Perbarui jumlah total tempat dalam tabel tbblok_parkir
            $query_update_total = "UPDATE tbblok_parkir SET Total_Tempat = Total_Tempat - 1 WHERE Blok = '$blok'";
            $result_total = mysqli_query($conn, $query_update_total);

            // Memeriksa apakah query berhasil dijalankan
            if ($sql && $result_terisi && $result_total) {
                $_SESSION['alertype'] = "Success";
                $_SESSION['alertmessage'] = "Data Berhasil Di Insert";
                // Kembali ke halaman dashboard
                echo "<script>document.location.href='print.php?id_parkir=$id_parkir&nopolisi=$nopolisi&merk=$merk&jenis=$jenis&blok=$blok&jammasuk=$jammasuk'</script>";
                exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
            } else {
                $_SESSION['alertype2'] = "Danger";
                $_SESSION['alertmessage2'] = "Gagal Melakukan Insert";
                header("Location: dashboard.php");
                exit();
            }
        }
    }
}
