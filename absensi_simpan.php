<?php
session_start();
include '../koneksi.php';

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$jurusan = $_POST['jurusan'];
$tanggal = $_POST['tanggal'];
$status = $_POST['status'];

/* Cegah absen dobel di tanggal sama */
$cek = mysqli_query($conn,
    "SELECT * FROM absensi WHERE nim='$nim' AND tanggal='$tanggal'"
);

if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Anda sudah absen hari ini');history.back();</script>";
    exit;
}

mysqli_query($conn,
    "INSERT INTO absensi (nim,nama,jurusan,tanggal,status)
     VALUES ('$nim','$nama','$jurusan','$tanggal','$status')"
);

echo "<script>alert('Absensi berhasil');location.href='absensi.php';</script>";
