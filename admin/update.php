<?php
include 'koneksi.php';

mysqli_query($conn, "UPDATE mata_kuliah SET
    nama_mk='$_POST[nama_mk]',
    sks='$_POST[sks]',
    semester='$_POST[semester]',
    jurusan='$_POST[jurusan]'
WHERE kode_mk='$_POST[kode_mk]'");

header("location:matakuliah.php");
