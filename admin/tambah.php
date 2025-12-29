<?php include '../config/koneksi.php'; ?>
<h2>Tambah Mata Kuliah</h2>

<form method="POST">
Kode MK: <input type="text" name="kode_mk" required><br>
Nama MK: <input type="text" name="nama_mk" required><br>
SKS: <input type="number" name="sks" required><br>
Semester: <input type="number" name="semester" required><br>
Jurusan: <input type="text" name="jurusan" required><br>
<button type="submit" name="simpan">Simpan</button>
</form>

<?php
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO mata_kuliah VALUES (
        '$_POST[kode_mk]',
        '$_POST[nama_mk]',
        '$_POST[sks]',
        '$_POST[semester]',
        '$_POST[jurusan]'
    )");
    echo "<script>alert('Data berhasil ditambah');location='matakuliah.php';</script>";
}
?>
