<?php
include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM mata_kuliah");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mata Kuliah</title>
    <link rel="stylesheet" href="matakuliah.css">
</head>
<body>

<div class="container">

    <div class="header">
        <h2>📘 Data Mata Kuliah</h2>
        <a href="tambah.php" class="btn-add">+ Tambah Mata Kuliah</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; while($d=mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['kode_mk'] ?></td>
                <td><?= $d['nama_mk'] ?></td>
                <td><?= $d['sks'] ?></td>
                <td><?= $d['semester'] ?></td>
                <td><?= $d['jurusan'] ?></td>
                <td class="aksi">
                    <a href="edit.php?kode_mk=<?= $d['kode_mk'] ?>" class="btn-edit">Edit</a>
                    <a href="hapus.php?kode_mk=<?= $d['kode_mk'] ?>" 
                       class="btn-delete"
                       onclick="return confirm('Yakin hapus data?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>
