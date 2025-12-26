<?php
include "koneksi.php";

$jurusan = $_GET['jurusan'] ?? '';

if ($jurusan == '') {
    die("Jurusan tidak valid");
}

// Query REAL dari database lo
$query = mysqli_query(
    $conn,
    "SELECT nim, nama, email, angkatan, status 
     FROM mahasiswa 
     WHERE jurusan = '$jurusan'
     ORDER BY nama ASC"
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Mahasiswa <?= htmlspecialchars($jurusan) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Data Mahasiswa</h1>
    <h3>Jurusan: <?= htmlspecialchars($jurusan) ?></h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Angkatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (mysqli_num_rows($query) > 0):
                while ($row = mysqli_fetch_assoc($query)):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nim'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['angkatan'] ?></td>
                <td><?= strtoupper($row['status']) ?></td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">Data mahasiswa kosong</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>