<?php
include '../config/koneksi.php';

if (isset($_POST['kode_mk'])) {

    $kode   = $_POST['kode_mk'];
    $nama   = $_POST['nama_mk'];
    $sks    = $_POST['sks'];
    $smt    = $_POST['semester'];
    $jur    = $_POST['jurusan'];

    mysqli_query($conn, "UPDATE mata_kuliah SET
        nama_mk='$nama',
        sks='$sks',
        semester='$smt',
        jurusan='$jur'
        WHERE kode_mk='$kode'
    ");

    header("Location: matakuliah.php");
    exit;
}
?>
