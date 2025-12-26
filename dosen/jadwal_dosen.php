<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "siakad");
$id_dosen = $_SESSION['id_dosen'] ?? 1;

$q = mysqli_query($conn, "
    SELECT j.*, m.nama_matakuliah 
    FROM jadwal j
    JOIN matakuliah m ON j.id_matakuliah = m.id
    WHERE j.id_dosen='$id_dosen'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Mengajar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="content">
    <div class="header-area">
        <h2>Jadwal Mengajar</h2>
    </div>

    <div class="table-container">
        <table>
            <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>Kelas</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Ruangan</th>
            </tr>
            <?php $no=1; while($d=mysqli_fetch_assoc($q)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['nama_matakuliah'] ?></td>
                <td><?= $d['kelas'] ?></td>
                <td><?= $d['hari'] ?></td>
                <td><?= $d['jam'] ?></td>
                <td><?= $d['ruangan'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
