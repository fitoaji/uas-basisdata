<?php
include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM mata_kuliah");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Mata Kuliah</title>
    <link rel="stylesheet" href="matakuliah.css">
</head>
<body>

<h2>Data Mata Kuliah</h2>
<a href="tambah_matakuliah.php">+ Tambah Mata Kuliah</a>

<table border="1" cellpadding="10">
<tr>
    <th>No</th>
    <th>Kode</th>
    <th>Nama</th>
    <th>SKS</th>
    <th>Semester</th>
    <th>Jurusan</th>
    <th>Dosen</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($d=mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['kode_mk'] ?></td>
    <td><?= $d['nama_mk'] ?></td>
    <td><?= $d['sks'] ?></td>
    <td><?= $d['semester'] ?></td>
    <td><?= $d['jurusan'] ?></td>
    <td><?= $d['dosen_pengampu'] ?></td>
    <td>
        <a href="edit_matakuliah.php?kode_mk=<?= $d['kode_mk'] ?>">Edit</a> |
        <a href="hapus_matakuliah.php?kode_mk=<?= $d['kode_mk'] ?>"
           onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

</body>
</html>
