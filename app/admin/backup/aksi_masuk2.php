<?php

include("../config.php");

session_start();

date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['kirim'])) {
    // Mengambil nilai dari form
    $nopolisi = $_POST['nopolisi'];
    $merk = $_POST['merk'];
    $jenis = $_POST['jenis'];
    $blok = $_POST['blok'];
    $jammasuk = date('Y-m-d H:i:s');

    // Memeriksa apakah semua field diisi
    if (empty($nopolisi) || empty($merk) || empty($jenis) || empty($blok) || empty($jammasuk)) {
        // Jika ada field yang kosong, tampilkan pesan kesalahan
        $_SESSION['alertype1'] = "Danger";
        $_SESSION['alertmessage1'] = "Semua Kolom Harus Diisi!";
        header("Location: parkir_masuk.php");
        exit();
    } else {
        // Query untuk mendapatkan tarif berdasarkan jenis kendaraan
        $query_tarif = "SELECT id_tarif, tarif FROM tbtarif_parkir WHERE Jenis='$jenis'";
        $hasil_tarif = mysqli_query($conn, $query_tarif);

        if (!$hasil_tarif) {
            // Jika query gagal, tampilkan pesan kesalahan
            $_SESSION['alertype1'] = "Danger";
            $_SESSION['alertmessage1'] = "Terjadi kesalahan dalam mengambil tarif parkir!";
            header("Location: parkir_masuk.php");
            exit();
        }

        $data_tarif = mysqli_fetch_array($hasil_tarif);

        if (!$data_tarif) {
            // Jika tidak menemukan tarif yang sesuai, tampilkan pesan kesalahan
            $_SESSION['alertype1'] = "Danger";
            $_SESSION['alertmessage1'] = "Tarif tidak ditemukan untuk jenis kendaraan tersebut!";
            header("Location: parkir_masuk.php");
            exit();
        }

        $id_tarif = $data_tarif['id_tarif'];
        $tarif = $data_tarif['tarif'];

        // Query untuk mendapatkan maksimum id_parkir
        $query = "SELECT max(cast(substring(id_parkir, 4) as signed)) as maxKode FROM tbpengendara_masuk";
        $hasil = mysqli_query($conn, $query);

        if (!$hasil) {
            // Jika query gagal, tampilkan pesan kesalahan
            $_SESSION['alertype1'] = "Danger";
            $_SESSION['alertmessage1'] = "Terjadi kesalahan dalam mengambil ID parkir maksimum!";
            header("Location: parkir_masuk.php");
            exit();
        }

        $data = mysqli_fetch_array($hasil);
        $maxKode = $data['maxKode'];
        $nourut = (int)$maxKode;
        $nourut++;
        $char = 'PRK';
        $id_parkir = $char . sprintf("%03s", $nourut);

        // Query untuk menyimpan data tbpengendara_masuk
        $query_masuk = "INSERT INTO tbpengendara_masuk (id_parkir, No_Polisi, Merk, Jenis, Blok, Jam_Masuk, id_tarif) 
                        VALUES('$id_parkir','$nopolisi', '$merk', '$jenis', '$blok', '$jammasuk', '$id_tarif')";

        $sql = mysqli_query($conn, $query_masuk);

        // Memeriksa apakah query berhasil dijalankan
        if ($sql) {
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
