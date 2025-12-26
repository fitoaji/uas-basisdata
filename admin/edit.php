<?php
include 'koneksi.php';
$kode = $_GET['kode_mk'];
$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM mata_kuliah WHERE kode_mk='$kode'")
);
?>

<h2>Edit Mata Kuliah</h2>

<form method="POST" action="update_matakuliah.php">
<input type="hidden" name="kode_mk" value="<?= $data['kode_mk'] ?>">

Nama MK: <input type="text" name="nama_mk" value="<?= $data['nama_mk'] ?>"><br>
SKS: <input type="number" name="sks" value="<?= $data['sks'] ?>"><br>
Semester: <input type="number" name="semester" value="<?= $data['semester'] ?>"><br>
Jurusan: <input type="text" name="jurusan" value="<?= $data['jurusan'] ?>"><br>
<button type="submit">Update</button>
</form>
