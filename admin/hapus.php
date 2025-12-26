<?php
include 'koneksi.php';
$kode = $_GET['kode_mk'];

mysqli_query($conn, "DELETE FROM mata_kuliah WHERE kode_mk='$kode'");
header("location:matakuliah.php");
